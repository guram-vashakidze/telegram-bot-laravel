<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait OrderInfoRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#orderinfo
 */
trait OrderInfoRules
{
    use RulesHelper;
    use ShippingAddressRules;

    protected function getOrderInfoRules(?string $prefix = null): array
    {
        $prefix = $this->getSetting($prefix)[0];

        return array_merge(
            [
                $prefix . 'name' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'phone_number' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'email' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'shipping_address' => [
                    'nullable',
                    'array',
                ],
            ],
            $this->getShippingAddressRules($prefix . 'shipping_address')
        );
    }
}
