<?php

namespace Vashakidze\Telegram\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\Message;

class TelegramMessageEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private Message $message)
    {
    }

    public function getMessage(): Message
    {
        return $this->message;
    }
}
