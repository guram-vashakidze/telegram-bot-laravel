<?php


namespace Vashakidze\Telegram\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\ShippingQuery;

class TelegramShippingQueryEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private ShippingQuery $shippingQuery)
    {
    }

    public function getShippingQuery(): ShippingQuery
    {
        return $this->shippingQuery;
    }
}
