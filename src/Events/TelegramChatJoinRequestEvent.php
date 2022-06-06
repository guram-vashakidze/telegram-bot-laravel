<?php


namespace Vashakidze\Telegram\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\ChatJoinRequest;

class TelegramChatJoinRequestEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private ChatJoinRequest $chatJoinRequest)
    {
    }

    public function getChatJoinRequest(): ChatJoinRequest
    {
        return $this->chatJoinRequest;
    }
}
