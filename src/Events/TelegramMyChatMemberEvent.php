<?php


namespace Vashakidze\Telegram\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\ChatMember;

class TelegramMyChatMemberEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private ChatMember $myChatMember)
    {
    }

    public function getMyChatMember(): ChatMember
    {
        return $this->myChatMember;
    }
}
