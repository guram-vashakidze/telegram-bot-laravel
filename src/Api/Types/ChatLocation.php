<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class ChatLocation
 * @package Vashakidze\Telegram\Api\Types
 *
 * Represents a location to which a chat is connected
 *
 * @link https://core.telegram.org/bots/api#chatlocation
 *
 * @property-read string $address
 * @property-read Location $location
 */
class ChatLocation extends Type
{
    protected string $address;
    protected Location $location;

    public static function init(array $data): self
    {
        $chatLocation = new self();

        $chatLocation->location = Location::init($data['location']);
        $chatLocation->address = $data['address'];

        return $chatLocation;
    }
}
