<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait ShippingQueryRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#shippingquery
 */
trait ShippingQueryRules
{
    use RulesHelper;
    use ShippingAddressRules;
    use UserRules;

    protected function getShippingQueryRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'id' => [
                    $required,
                    'string',
                ],
                $prefix . 'from' => [
                    $required,
                    'array',
                ],
                $prefix . 'invoice_payload' => [
                    $required,
                    'string'
                ],
                $prefix . 'shipping_address' => [
                    $required,
                    'array'
                ],
            ],
            $this->getUserRules($prefix . 'from'),
            $this->getShippingAddressRules($prefix . 'shipping_address')
        );
    }
}
