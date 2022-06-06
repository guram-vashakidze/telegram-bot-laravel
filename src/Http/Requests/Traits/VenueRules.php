<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait VenueRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#venue
 */
trait VenueRules
{
    use RulesHelper;
    use LocationRules;

    protected function getVenueRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'location' => [
                    $required,
                    'array',
                ],
                $prefix . 'title' => [
                    $required,
                    'string',
                ],
                $prefix . 'address' => [
                    $required,
                    'string',
                ],
                $prefix . 'foursquare_id' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'foursquare_type' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'google_place_id' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'google_place_type' => [
                    'nullable',
                    'string',
                ],
            ],
            $this->getLocationRules($prefix . 'location')
        );
    }
}
