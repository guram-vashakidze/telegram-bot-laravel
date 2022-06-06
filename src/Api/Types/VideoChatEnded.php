<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class VideoChatEnded
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a service message about a video chat ended in the chat
 *
 * @link https://core.telegram.org/bots/api#videochatended
 *
 * @property-read int $duration Video chat duration in seconds
 */
class VideoChatEnded extends Type
{
    protected int $duration;

    public static function init(array $data): self
    {
        $videoChatEnded = new self();

        $videoChatEnded->duration = $data['duration'];

        return $videoChatEnded;
    }
}
