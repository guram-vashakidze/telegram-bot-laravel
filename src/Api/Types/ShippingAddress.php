<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class ShippingAddress
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a shipping address.
 *
 * @link https://core.telegram.org/bots/api#shippingaddress
 *
 * @property-read string $countryCode ISO 3166-1 alpha-2 country code
 * @property-read string $state State, if applicable
 * @property-read string $city City
 * @property-read string $streetLine1 First line for the address
 * @property-read string $streetLine2 Second line for the address
 * @property-read string $postCode Address post code
 */
class ShippingAddress extends Type
{
    protected string $countryCode;
    protected string $state;
    protected string $city;
    protected string $streetLine1;
    protected string $streetLine2;
    protected string $postCode;

    public static function init(array $data): self
    {
        $shippingAddress = new self();

        $shippingAddress->countryCode = $data['country_code'];
        $shippingAddress->state = $data['state'];
        $shippingAddress->city = $data['city'];
        $shippingAddress->streetLine1 = $data['street_line1'];
        $shippingAddress->streetLine2 = $data['street_line2'];
        $shippingAddress->postCode = $data['post_code'];

        return $shippingAddress;
    }
}
