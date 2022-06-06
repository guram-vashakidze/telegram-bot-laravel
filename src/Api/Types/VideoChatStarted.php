<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class VideoChatStarted
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a service message about a video chat started in the chat. Currently holds no information
 *
 * @link https://core.telegram.org/bots/api#videochatstarted
 */
class VideoChatStarted extends Type
{
    public static function init(array $data): self
    {
        return new self();
    }
}
