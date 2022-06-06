<?php

namespace Vashakidze\Telegram\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\Message;

class TelegramEditMessageEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private Message $editMessage)
    {
    }

    public function getEditMessage(): Message
    {
        return $this->editMessage;
    }
}
