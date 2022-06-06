<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class ShippingQuery
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object contains information about an incoming shipping query
 *
 * @link https://core.telegram.org/bots/api#shippingquery
 *
 * @property-read string $id Unique query identifier
 * @property-read User $from User who sent the query
 * @property-read string $invoicePayload Bot specified invoice payload
 * @property-read ShippingAddress $shippingAddress User specified shipping address
 */
class ShippingQuery extends Type
{
    protected string $id;
    protected User $from;
    protected string $invoicePayload;
    protected ShippingAddress $shippingAddress;

    public static function init(array $data): self
    {
        $shippingQuery = new self();

        $shippingQuery->id = $data['id'];
        $shippingQuery->from = User::init($data['from']);
        $shippingQuery->invoicePayload = $data['invoice_payload'];
        $shippingQuery->shippingAddress = ShippingAddress::init($data['shipping_address']);

        return $shippingQuery;
    }
}
