<?php

namespace Vashakidze\Telegram\Console\Commands;

use Illuminate\Console\Command;
use Vashakidze\Telegram\Exceptions\TelegramApiException;
use Vashakidze\Telegram\TelegramApi;

/**
 * Class TelegramBotLogOut
 * @package Vashakidze\Telegram\Console\Commands
 *
 * @link https://core.telegram.org/bots/api#logout
 */
class TelegramBotLogOut extends Command
{
    /**
     * @var string
     */
    protected $signature = 'telegram:bot:log-out';

    /**
     * @var string
     */
    protected $description = 'Log out telegram bot';

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
            if ($this->api->logOut()) {
                $this->info("Bot was logged out");
            } else {
                $this->warn("Bot was not logged out");
            }
            return self::SUCCESS;
        } catch (TelegramApiException $exception) {
            $this->error($exception->getDescription());

            return self::FAILURE;
        }
    }
}
