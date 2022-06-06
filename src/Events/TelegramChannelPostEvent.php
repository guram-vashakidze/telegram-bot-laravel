<?php


namespace Vashakidze\Telegram\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\Message;

class TelegramChannelPostEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private Message $channelPost)
    {
    }

    public function getChannelPost(): Message
    {
        return $this->channelPost;
    }
}
