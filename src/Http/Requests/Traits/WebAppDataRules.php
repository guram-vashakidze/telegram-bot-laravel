<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


/**
 * Trait WebAppDataRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#webappdata
 */
trait WebAppDataRules
{
    use RulesHelper;

    protected function getWebAppDataRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'data' => [
                $required,
                'string',
            ],
            $prefix . 'button_text' => [
                $required,
                'string',
            ],
        ];
    }
}
