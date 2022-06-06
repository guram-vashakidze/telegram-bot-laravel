<?php


namespace Vashakidze\Telegram\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\ChatMember;

class TelegramChatMemberEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private ChatMember $chatMember)
    {
    }

    public function getChatMember(): ChatMember
    {
        return $this->chatMember;
    }
}
