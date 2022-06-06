<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use BenSampo\Enum\Rules\EnumValue;

use Vashakidze\Telegram\Api\Enums\ChatType;

use function array_merge;

/**
 * Trait InlineQueryRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#inlinequery
 */
trait InlineQueryRules
{
    use RulesHelper;
    use LocationRules;
    use UserRules;

    protected function getInlineQueryRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'id' => [
                    $required,
                    'string',
                ],
                $prefix . 'from' => [
                    $required,
                    'array',
                ],
                $prefix . 'query' => [
                    $required,
                    'string'
                ],
                $prefix . 'offset' => [
                    $required,
                    'string'
                ],
                $prefix . 'chat_type' => [
                    'nullable',
                    'string',
                    new EnumValue(ChatType::class)
                ],
                $prefix . 'location' => [
                    'nullable',
                    'array'
                ]
            ],
            $this->getUserRules($prefix . 'from'),
            $this->getLocationRules($prefix . 'location'),
        );
    }
}
