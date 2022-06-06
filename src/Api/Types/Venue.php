<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class Venue
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a venue.
 *
 * @link https://core.telegram.org/bots/api#venue
 *
 * @property-read Location $location Venue location. Can't be a live location
 * @property-read string $title Name of the venue
 * @property-read string $address Address of the venue
 * @property-read string $foursquareId Foursquare identifier of the venue
 * @property-read string $foursquareType Foursquare type of the venue
 * @property-read string $googlePlaceId Google Places identifier of the venue
 * @property-read string $googlePlaceType Google Places type of the venue
 */
class Venue extends Type
{
    protected Location $location;
    protected string $title;
    protected string $address;
    protected ?string $foursquareId;
    protected ?string $foursquareType;
    protected ?string $googlePlaceId;
    protected ?string $googlePlaceType;

    public static function init(array $data): self
    {
        $venue = new self();

        $venue->location = Location::init($data['location']);
        $venue->title = $data['title'];
        $venue->foursquareId = $data['foursquare_id'] ?? null;
        $venue->foursquareType = $data['foursquare_type'] ?? null;
        $venue->googlePlaceId = $data['google_place_id'] ?? null;
        $venue->googlePlaceType = $data['google_place_type'] ?? null;

        return $venue;
    }
}
