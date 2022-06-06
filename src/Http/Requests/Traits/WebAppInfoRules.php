<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait WebAppInfoRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#webappinfo
 */
trait WebAppInfoRules
{
    use RulesHelper;

    protected function getWebAppInfoRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'url' => [
                $required,
                'string',
            ],
        ];
    }
}
