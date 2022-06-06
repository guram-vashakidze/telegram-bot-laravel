<?php

use Illuminate\Support\Facades\Route;
use Vashakidze\Telegram\Http\Controllers\TelegramWebhookController;
use Vashakidze\Telegram\Http\Middleware\TelegramWebhookMiddleware;

Route::middleware(TelegramWebhookMiddleware::class)
    ->post(
        'webhook/telegram',
        TelegramWebhookController::class
    )
    ->name('webhook.telegram');
