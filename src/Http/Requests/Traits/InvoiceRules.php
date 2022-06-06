<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait InvoiceRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#invoice
 */
trait InvoiceRules
{
    use RulesHelper;

    protected function getInvoiceRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'title' => [
                $required,
                'string',
            ],
            $prefix . 'description' => [
                $required,
                'string',
            ],
            $prefix . 'start_parameter' => [
                $required,
                'string',
            ],
            $prefix . 'currency' => [
                $required,
                'string',
            ],
            $prefix . 'total_amount' => [
                $required,
                'int',
            ],
        ];
    }
}
