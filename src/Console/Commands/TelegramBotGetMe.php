<?php

namespace Vashakidze\Telegram\Console\Commands;

use Illuminate\Console\Command;
use Vashakidze\Telegram\Exceptions\TelegramApiException;
use Vashakidze\Telegram\TelegramApi;

/**
 * Class TelegramBotGetMe
 * @package Vashakidze\Telegram\Console\Commands
 *
 * @link https://core.telegram.org/bots/api#getme
 */
class TelegramBotGetMe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:bot:get-me';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get bot setting';

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
            $botData = $this->api->getMe()->toArray();

            $table = [];

            foreach ($botData as $name => $value) {
                $table[] = [
                    $name,
                    $value
                ];
            }

            $this->table(
                [
                    'Parameter',
                    'value'
                ],
                $table
            );
            return self::SUCCESS;
        } catch (TelegramApiException $exception) {
            $this->error($exception->getDescription());

            return self::FAILURE;
        }
    }
}
