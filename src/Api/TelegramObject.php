<?php


namespace Vashakidze\Telegram\Api;


use BenSampo\Enum\Enum;
use Carbon\Carbon;
use Illuminate\Support\Str;
use JsonSerializable;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use ReflectionProperty;
use ReflectionUnionType;
use Vashakidze\Telegram\Api\InputTypes\InputFile;
use Vashakidze\Telegram\Exceptions\TelegramArgsException;

use function json_encode;
use function lcfirst;
use function preg_match;
use function preg_replace;

abstract class TelegramObject
{
    /**@var InputFile[] $files*/
    private array $files;

    /**
     * @param string $key
     * @return mixed
     */
    public function __get(string $key): mixed
    {
        if (property_exists($this, $key)) {
            return $this->{$key};
        }
        return null;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return TelegramObject|null
     * @throws TelegramArgsException
     */
    public function __call(string $name, array $arguments): ?static
    {
        if (!preg_match("/^set[A-Z]/", $name)) {
            return null;
        }

        $propertyName = lcfirst(
            preg_replace("/^set/", "", $name)
        );

        $reflection = new ReflectionClass(static::class);

        try {
            $property = $reflection->getProperty($propertyName);
        } catch (ReflectionException) {
            throw new TelegramArgsException("Incorrect field: " . $propertyName);
        }
        /**@var ReflectionUnionType|ReflectionNamedType $expectedPropertyType*/
        $expectedPropertyType = $property->getType();

        if ($expectedPropertyType instanceof ReflectionNamedType) {
            $expectedPropertyTypes = [$expectedPropertyType];
        } else {
            $expectedPropertyTypes = $expectedPropertyType->getTypes();
        }

        $types = [];

        foreach ($expectedPropertyTypes as $item) {
            $types[] = $item->getName();
        }
        if ($expectedPropertyType->allowsNull()) {
            $types[] = 'null';
        }

        if (!array_key_exists(0, $arguments)) {
            if (in_array('bool', $types) || in_array('boolean', $types)) {
                $propertyValue = true;
            } else {
                throw new TelegramArgsException("Method " . $name . " not allowed null argument");
            }
        } else {
            $propertyValue = $arguments[0];
        }

        $currentPropertyType = is_object($propertyValue) ? get_class($propertyValue) : get_debug_type($propertyValue);

        if (!in_array($currentPropertyType, $types)) {
            throw new TelegramArgsException("Incorrect field: " . $propertyName . '. Expected types: ' . implode(", ", $types) . '. You set: ' . $currentPropertyType);
        }
        $this->{$propertyName} = $propertyValue;

        return $this;
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);

        $result = [];

        foreach ($properties as $name => $value) {
            $result[Str::snake($name)] = $this->renderArgsValue($value, serialize: false);
        }

        return $result;
    }

    public static function args(array $args = []): static
    {
        if (empty($args)) {
            return new static();
        }
        $type = new static();

        foreach ($args as $argName => $argValue) {
            $type->{'set' . Str::studly($argName)}($argValue);
        }

        return $type;
    }

    /**
     * @return array
     * @throws TelegramArgsException
     */
    public function toRequest(): array
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties();
        $nonRequestArgs = $reflection->getConstant('NON_REQUEST_ARGS') ?: [];
        $result = [];
        $this->files = [];

        foreach ($properties as $property) {
            if (in_array($property->getName(), $nonRequestArgs)) {
                continue;
            }

            if (!$property->getType()->allowsNull() && !$property->isInitialized($this)) {
                throw new TelegramArgsException("Field \"" . $property->getName() . "\" is required");
            }

            if (!$property->isInitialized($this) || $this->{$property->getName()} === null) {
                continue;
            }

            $value = $this->{$property->getName()};

            if ($value instanceof InputFile) {
                $this->files[] = $value;

                continue;
            }

            $result[Str::snake($property->getName())] = $this->renderArgsValue($value, $property);
        }

        return $result;
    }

    /**
     * @param mixed $value
     * @param ReflectionProperty|null $property
     * @param bool $serialize
     * @return mixed
     * @throws TelegramArgsException
     */
    private function renderArgsValue(mixed $value, ?ReflectionProperty $property = null, bool $serialize = true): mixed
    {
        if ($value instanceof JsonSerializable && $value instanceof TelegramObject && $serialize) {
            $value = json_encode($value);
        } elseif ($value instanceof Carbon) {
            $value = $value->getTimestamp();
        } elseif ($value instanceof Enum) {
            $value = $value->value;
        } elseif ($value instanceof TelegramObject) {
            $value = $value->toRequest();
        } elseif (is_array($value)) {
            for ($i = 0, $max = count($value); $i < $max; $i++) {
                $value[$i] = $this->renderArgsValue($value[$i]);
            }

            if ($property?->getType() instanceof ReflectionUnionType && $serialize) {
                foreach ($property->getType()->getTypes() as $type) {
                    if ($type->getName() === JsonSerializable::class) {
                        $value = json_encode($value);
                    }
                }
            }
        }
        return $value;
    }

    public function isSetFiles(): bool
    {
        return !empty($this->files);
    }

    public function getFiles(): array
    {
        return $this->files;
    }
}
