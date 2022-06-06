<?php


namespace Vashakidze\Telegram\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\Poll;

class TelegramPollEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private Poll $poll)
    {
    }

    public function getPoll(): Poll
    {
        return $this->poll;
    }
}
