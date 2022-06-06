<?php


namespace Vashakidze\Telegram\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\InlineQuery;

class TelegramInlineQueryEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private InlineQuery $inlineQuery)
    {
    }

    public function getInlineQuery(): InlineQuery
    {
        return $this->inlineQuery;
    }
}
