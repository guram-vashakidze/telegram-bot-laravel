<?php


namespace Vashakidze\Telegram\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\ChosenInlineResult;

class TelegramChosenInlineResultEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private ChosenInlineResult $chosenInlineResult)
    {
    }

    public function getChosenInlineResult(): ChosenInlineResult
    {
        return $this->chosenInlineResult;
    }
}
