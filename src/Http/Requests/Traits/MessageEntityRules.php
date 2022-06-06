<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use BenSampo\Enum\Rules\EnumValue;
use Vashakidze\Telegram\Api\Enums\MessageEntityType;

use function array_merge;

/**
 * Trait MessageEntityRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#messageentity
 */
trait MessageEntityRules
{
    use RulesHelper;
    use UserRules;

    protected function getMessageEntityRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'type' => [
                    $required,
                    'string',
                    new EnumValue(MessageEntityType::class)
                ],
                $prefix . 'offset' => [
                    $required,
                    'int',
                ],
                $prefix . 'length' => [
                    $required,
                    'int',
                ],
                $prefix . 'url' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'user' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'language' => [
                    'nullable',
                    'string'
                ]
            ],
            $this->getUserRules($prefix . 'user')
        );
    }
}
