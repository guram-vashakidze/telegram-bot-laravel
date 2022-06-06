<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class MessageAutoDeleteTimerChanged
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a service message about a change in auto-delete timer settings
 *
 * @link https://core.telegram.org/bots/api#messageautodeletetimerchanged
 *
 * @property-read int $messageAutoDeleteTime New auto-delete time for messages in the chat; in seconds
 */
class MessageAutoDeleteTimerChanged extends Type
{
    protected int $messageAutoDeleteTime;

    public static function init(array $data): self
    {
        $timer = new self();

        $timer->messageAutoDeleteTime = $data['message_auto_delete_time'];

        return $timer;
    }
}
