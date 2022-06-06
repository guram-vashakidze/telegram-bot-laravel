<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait InlineKeyboardMarkupRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
 */
trait InlineKeyboardMarkupRules
{
    use RulesHelper;
    use InlineKeyboardButtonRules;

    protected function getInlineKeyboardMarkupRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'inline_keyboard' => [
                    $required,
                    'array',
                ],
            ],
            $this->getInlineKeyboardButtonRules($prefix . 'inline_keyboard.*.*')
        );
    }
}
