<?php

namespace Vashakidze\Telegram\Console\Commands;

use Illuminate\Console\Command;
use Vashakidze\Telegram\Exceptions\TelegramApiException;
use Vashakidze\Telegram\TelegramApi;

/**
 * Class TelegramBotClose
 * @package Vashakidze\Telegram\Console\Commands
 *
 * @link https://core.telegram.org/bots/api#close
 */
class TelegramBotClose extends Command
{
    /**
     * @var string
     */
    protected $signature = 'telegram:bot:close';

    /**
     * @var string
     */
    protected $description = 'Close telegram bot';

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
            if ($this->api->close()) {
                $this->info("Bot was closed");
            } else {
                $this->warn("Bot was not closed");
            }

            return self::SUCCESS;
        } catch (TelegramApiException $exception) {
            $this->error($exception->getDescription());

            return self::FAILURE;
        }
    }
}
