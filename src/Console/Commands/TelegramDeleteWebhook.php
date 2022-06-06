<?php

namespace Vashakidze\Telegram\Console\Commands;

use Illuminate\Console\Command;
use Vashakidze\Telegram\Exceptions\TelegramApiException;
use Vashakidze\Telegram\TelegramApi;

/**
 * Class TelegramDeleteWebhook
 * @package Vashakidze\Telegram\Console\Commands
 *
 * @link https://core.telegram.org/bots/api#deletewebhook
 */
class TelegramDeleteWebhook extends Command
{
    /**
     * @var string
     */
    protected $signature = 'telegram:webhook:delete';

    /**
     * @var string
     */
    protected $description = 'Delete webhook setting';

    public function __construct(private TelegramApi $api)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            if ($this->api->deleteWebhook()) {
                $this->info("Webhook was successfully deleted");
            } else {
                $this->warn("Webhook was not deleted");
            }

            return self::SUCCESS;
        } catch (TelegramApiException $exception) {
            $this->error($exception->getDescription());

            return self::FAILURE;
        }
    }
}
