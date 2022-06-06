<?php

namespace Vashakidze\Telegram\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Vashakidze\Telegram\Api\Types\Update;

class TelegramUpdateEvent
{
    use Dispatchable;
    use InteractsWithSockets;

    public function __construct(private Update $update)
    {
    }

    public function getUpdate(): Update
    {
        return $this->update;
    }
}
