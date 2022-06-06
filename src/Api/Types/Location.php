<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class Location
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a point on the map
 *
 * @link https://core.telegram.org/bots/api#location
 *
 * @property-read float $longitude - Longitude as defined by sender
 * @property-read float $latitude - Latitude as defined by sender
 * @property-read float|null $horizontalAccuracy - The radius of uncertainty for the location, measured in meters; 0-1500
 * @property-read int|null $livePeriod - Time relative to the message sending date, during which the location can be updated; in seconds. For active live locations only.
 * @property-read int|null $heading - The direction in which user is moving, in degrees; 1-360. For active live locations only.
 * @property-read int|null $proximityAlertRadius - Maximum distance for proximity alerts about approaching another chat member, in meters. For sent live locations only.
 */
class Location extends Type
{
    protected float $longitude;
    protected float $latitude;
    protected ?float $horizontalAccuracy;
    protected ?int $livePeriod;
    protected ?int $heading;
    protected ?int $proximityAlertRadius;

    public static function init(array $data): self
    {
        $location = new self();

        $location->longitude = $data['longitude'];
        $location->latitude = $data['latitude'];
        $location->horizontalAccuracy = $data['horizontal_accuracy'] ?? null;
        $location->livePeriod = $data['live_period'] ?? null;
        $location->heading = $data['heading'] ?? null;
        $location->proximityAlertRadius = $data['proximity_alert_radius'] ?? null;

        return $location;
    }
}
