<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait ShippingAddressRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#shippingaddress
 */
trait ShippingAddressRules
{
    use RulesHelper;

    protected function getShippingAddressRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'country_code' => [
                $required,
                'string',
            ],
            $prefix . 'state' => [
                $required,
                'string',
            ],
            $prefix . 'city' => [
                $required,
                'string',
            ],
            $prefix . 'street_line1' => [
                $required,
                'string',
            ],
            $prefix . 'street_line2' => [
                $required,
                'string',
            ],
            $prefix . 'post_code' => [
                $required,
                'string',
            ],
        ];
    }
}
