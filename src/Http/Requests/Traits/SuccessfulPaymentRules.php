<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait SuccessfulPaymentRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#successfulpayment
 */
trait SuccessfulPaymentRules
{
    use RulesHelper;
    use OrderInfoRules;

    protected function getSuccessfulPaymentRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'currency' => [
                    $required,
                    'string',
                ],
                $prefix . 'total_amount' => [
                    $required,
                    'int',
                ],
                $prefix . 'invoice_payload' => [
                    $required,
                    'string',
                ],
                $prefix . 'shipping_option_id' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'order_info' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'telegram_payment_charge_id' => [
                    $required,
                    'string',
                ],
                $prefix . 'provider_payment_charge_id' => [
                    $required,
                    'string',
                ],
            ],
            $this->getOrderInfoRules($prefix . 'order_info')
        );
    }
}
