<?php

namespace Vashakidze\Telegram;

use Illuminate\Support\ServiceProvider;
use Vashakidze\Telegram\Console\Commands\TelegramBotClose;
use Vashakidze\Telegram\Console\Commands\TelegramBotGetMe;
use Vashakidze\Telegram\Console\Commands\TelegramBotLogOut;
use Vashakidze\Telegram\Console\Commands\TelegramCheckSetting;
use Vashakidze\Telegram\Console\Commands\TelegramDeleteWebhook;

/**
 * Class TelegramServiceProvider
 * @package Vashakidze\Telegram
 *
 * @author Guram Vashakidze
 */
class TelegramServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'webhook.php');
        $this->mergeConfigFrom(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'telegram.php', 'telegram');

        if ($this->app->runningInConsole()) {
            $this->commands([
                TelegramBotGetMe::class,
                TelegramBotClose::class,
                TelegramBotLogOut::class,

                TelegramCheckSetting::class,
                TelegramDeleteWebhook::class,
            ]);
        }
    }

    public function register()
    {
        $this->app->bind(
            'vashakidze_telegram',
            fn () => new TelegramApi()
        );
    }
}
