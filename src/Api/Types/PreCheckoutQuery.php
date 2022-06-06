<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class PreCheckoutQuery
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object contains information about an incoming pre-checkout query
 *
 * @link https://core.telegram.org/bots/api#precheckoutquery
 *
 * @property-read string $id Unique query identifier
 * @property-read User $from User who sent the query
 * @property-read string $currency Three-letter ISO 4217 currency code
 * @property-read int $totalAmount Total price in the smallest units of the currency (integer, not float/double)
 * @property-read string $invoicePayload Bot specified invoice payload
 * @property-read string|null $shippingOptionId Identifier of the shipping option chosen by the user
 * @property-read OrderInfo|null $orderInfo Order info provided by the user
 */
class PreCheckoutQuery extends Type
{
    protected string $id;
    protected User $from;
    protected string $currency;
    protected int $totalAmount;
    protected string $invoicePayload;
    protected ?string $shippingOptionId;
    protected ?OrderInfo $orderInfo;

    public static function init(array $data): self
    {
        $checkout = new self();

        $checkout->id = $data['id'];
        $checkout->from = User::init($data['from']);
        $checkout->currency = $data['currency'];
        $checkout->totalAmount = $data['total_amount'];
        $checkout->shippingOptionId = $data['shipping_option_id'] ?? null;
        $checkout->orderInfo = !empty($data['order_info']) ? OrderInfo::init($data['order_info']) : null;

        return $checkout;
    }
}
