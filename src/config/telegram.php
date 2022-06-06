<?php

return [
    'api' => [
        'token' => env('TELEGRAM_API_TOKEN'),
        'url' => env('TELEGRAM_API_URL', 'https://api.telegram.org/'),
    ],
    'webhook' => [
        'url' => env('TELEGRAM_WEBHOOK_URL'),
        'token' => env('TELEGRAM_WEBHOOK_TOKEN'),
        'setting' => [
            'certificate' => null,
            'allowed_updates' => Vashakidze\Telegram\Api\Enums\WebhookUpdateType::getValues(),
            'ip_address' => null,
            'max_connections' => null,
            'drop_pending_updates' => null,
        ],
    ],
];
