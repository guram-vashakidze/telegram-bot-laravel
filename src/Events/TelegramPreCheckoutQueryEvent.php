<?php


namespace Vashakidze\Telegram\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\PreCheckoutQuery;

class TelegramPreCheckoutQueryEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private PreCheckoutQuery $preCheckoutQuery)
    {
    }

    public function getPreCheckoutQuery(): PreCheckoutQuery
    {
        return $this->preCheckoutQuery;
    }
}
