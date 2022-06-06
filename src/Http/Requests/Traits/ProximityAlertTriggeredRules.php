<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait ProximityAlertTriggeredRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#proximityalerttriggered
 */
trait ProximityAlertTriggeredRules
{
    use RulesHelper;
    use UserRules;

    protected function getProximityAlertTriggeredRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'traveler' => [
                    $required,
                    'array',
                ],
                $prefix . 'watcher' => [
                    $required,
                    'array',
                ],
                $prefix . 'distance' => [
                    $required,
                    'int'
                ]
            ],
            $this->getUserRules($prefix . 'traveler'),
            $this->getUserRules($prefix . 'watcher'),
        );
    }
}
