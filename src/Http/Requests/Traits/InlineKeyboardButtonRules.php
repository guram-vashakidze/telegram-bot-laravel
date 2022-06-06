<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

use function array_merge;

/**
 * Trait InlineKeyboardButtonRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#inlinekeyboardbutton
 */
trait InlineKeyboardButtonRules
{
    use RulesHelper;
    use WebAppInfoRules;
    use LoginUrlRules;

    protected function getInlineKeyboardButtonRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'text' => [
                    $required,
                    'string'
                ],
                $prefix . 'url' => [
                    'nullable',
                    'string'
                ],
                $prefix . 'callback_data' => [
                    'nullable',
                    'string'
                ],
                $prefix . 'web_app' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'login_url' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'switch_inline_query' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'switch_inline_query_current_chat' => [
                    'nullable',
                    'string'
                ],
                $prefix . 'callback_game' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'pay' => [
                    'nullable',
                    'boolean'
                ]
            ],
            $this->getWebAppInfoRules($prefix . 'web_app'),
            $this->getLoginUrlRules($prefix . 'login_url')
        );
    }
}
