<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use BenSampo\Enum\Rules\EnumValue;
use Vashakidze\Telegram\Api\Enums\EncryptedPassportElementType;

use function array_merge;

/**
 * Trait EncryptedPassportElement
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#encryptedpassportelement
 */
trait EncryptedPassportElementRules
{
    use RulesHelper;
    use PassportFileRules;

    protected function getEncryptedPassportElementRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'type' => [
                    $required,
                    'string',
                    new EnumValue(EncryptedPassportElementType::class)
                ],
                $prefix . 'data' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'phone_number' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'email' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'files' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'front_side' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'reverse_side' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'selfie' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'translation' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'hash' => [
                    $required,
                    'string'
                ],
            ],
            $this->getPassportFileRules($prefix . 'files.*'),
            $this->getPassportFileRules($prefix . 'front_side'),
            $this->getPassportFileRules($prefix . 'reverse_side'),
            $this->getPassportFileRules($prefix . 'selfie'),
            $this->getPassportFileRules($prefix . 'translation.*'),
        );
    }
}
