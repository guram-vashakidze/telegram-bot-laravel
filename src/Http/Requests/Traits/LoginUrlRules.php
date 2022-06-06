<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


/**
 * Trait LoginUrlRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#loginurl
 */
trait LoginUrlRules
{
    use RulesHelper;

    protected function getLoginUrlRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'url' => [
                $required,
                'string',
            ],
            $prefix . 'forward_text' => [
                'nullable',
                'string',
            ],
            $prefix . 'bot_username' => [
                'nullable',
                'int',
            ],
        ];
    }
}
