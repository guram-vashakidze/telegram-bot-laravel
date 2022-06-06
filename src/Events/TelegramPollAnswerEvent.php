<?php


namespace Vashakidze\Telegram\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\PollAnswer;

class TelegramPollAnswerEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private PollAnswer $pollAnswer)
    {
    }

    public function getPollAnswer(): PollAnswer
    {
        return $this->pollAnswer;
    }
}
