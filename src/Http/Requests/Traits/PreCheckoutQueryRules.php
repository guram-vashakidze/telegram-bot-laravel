<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait PreCheckoutQueryRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#precheckoutquery
 */
trait PreCheckoutQueryRules
{
    use RulesHelper;
    use UserRules;
    use OrderInfoRules;

    protected function getPreCheckoutQueryRules(?string $prefix = null): array
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
                $prefix . 'currency' => [
                    $required,
                    'string'
                ],
                $prefix . 'total_amount' => [
                    $required,
                    'int'
                ],
                $prefix . 'invoice_payload' => [
                    $required,
                    'string'
                ],
                $prefix . 'shipping_option_id' => [
                    'nullable',
                    'string'
                ],
                $prefix . 'order_info' => [
                    'nullable',
                    'array'
                ],

            ],
            $this->getUserRules($prefix . 'from'),
            $this->getOrderInfoRules($prefix . 'order_info'),
        );
    }
}
