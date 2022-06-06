<?php


namespace Vashakidze\Telegram\Api\Types;


use Carbon\Carbon;
use Vashakidze\Telegram\Api\Type;

/**
 * Class VideoChatScheduled
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a service message about a video chat scheduled in the chat
 *
 * @link https://core.telegram.org/bots/api#videochatscheduled
 *
 * @property-read Carbon $startDate Point in time (Unix timestamp) when the video chat is supposed to be started by a chat administrator
 */
class VideoChatScheduled extends Type
{
    protected Carbon $startDate;

    public static function init(array $data): self
    {
        $videoChatScheduled = new self();

        $videoChatScheduled->startDate = Carbon::createFromTimestamp($data['start_date']);

        return $videoChatScheduled;
    }
}
