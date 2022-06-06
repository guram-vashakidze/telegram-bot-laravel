<?php


namespace Vashakidze\Telegram\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\CallbackQuery;

class TelegramCallbackQueryEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private CallbackQuery $callbackQuery)
    {
    }

    public function getCallbackQuery(): CallbackQuery
    {
        return $this->callbackQuery;
    }
}
