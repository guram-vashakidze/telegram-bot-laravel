<?php


namespace Vashakidze\Telegram\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\Message;

class TelegramEditedChannelPostEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private Message $editedChannelPost)
    {
    }

    public function getEditedChannelPost(): Message
    {
        return $this->editedChannelPost;
    }
}
