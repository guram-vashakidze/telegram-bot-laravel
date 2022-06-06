<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class OrderInfo
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents information about an order
 *
 * @link https://core.telegram.org/bots/api#orderinfo
 *
 * @property-read string|null $name User name
 * @property-read string|null $phoneNumber User's phone number
 * @property-read string|null $email User email
 * @property-read ShippingAddress|null $shippingAddress User shipping address
 */
class OrderInfo extends Type
{
    protected ?string $name;
    protected ?string $phoneNumber;
    protected ?string $email;
    protected ?ShippingAddress $shippingAddress;

    public static function init(array $data): self
    {
        $orderInfo = new self();

        $orderInfo->name = $data['name'] ?? null;
        $orderInfo->phoneNumber = $data['phone_number'] ?? null;
        $orderInfo->email = $data['email'] ?? null;
        $orderInfo->shippingAddress = !empty($data['shipping_address']) ? ShippingAddress::init($data['shipping_address']) : null;

        return $orderInfo;
    }
}
