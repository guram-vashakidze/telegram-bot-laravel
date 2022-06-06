<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class ProximityAlertTriggered
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents the content of a service message, sent whenever a user in the chat triggers a proximity alert set by another user
 *
 * @link https://core.telegram.org/bots/api#proximityalerttriggered
 *
 * @property-read User $traveler
 * @property-read User $watcher
 * @property-read int $distance
 */
class ProximityAlertTriggered extends Type
{
    protected User $traveler;
    protected User $watcher;
    protected int $distance;

    public static function init(array $data): self
    {
        $trigger = new self();

        $trigger->traveler = User::init($data['traveler']);
        $trigger->watcher = User::init($data['watcher']);
        $trigger->distance = $data['distance'];

        return $trigger;
    }
}
