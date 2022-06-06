<?php

namespace Vashakidze\Telegram\Http\Controllers;

use Illuminate\Routing\Controller;
use Vashakidze\Telegram\Events\TelegramUpdateEvent;
use Vashakidze\Telegram\Http\Requests\TelegramWebhookRequest;

use function event;

class TelegramWebhookController extends Controller
{
    public function __invoke(TelegramWebhookRequest $request)
    {
        $update = $request->toType();

        event(new TelegramUpdateEvent($update));

        $event = $update->type->getEvent();

        event(new $event($update->{$update->type->toPropertyName()}));
    }
}
