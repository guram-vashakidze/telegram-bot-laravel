<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait LocationRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#location
 */
trait LocationRules
{
    use RulesHelper;

    protected function getLocationRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'longitude' => [
                $required,
                'numeric',
            ],
            $prefix . 'latitude' => [
                $required,
                'numeric',
            ],
            $prefix . 'horizontal_accuracy' => [
                'nullable',
                'numeric',
            ],
            $prefix . 'live_period' => [
                'nullable',
                'int',
            ],
            $prefix . 'heading' => [
                'nullable',
                'int',
            ],
            $prefix . 'proximity_alert_radius' => [
                'nullable',
                'int',
            ],
        ];
    }
}
