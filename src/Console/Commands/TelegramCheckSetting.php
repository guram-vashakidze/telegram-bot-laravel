<?php

namespace Vashakidze\Telegram\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Vashakidze\Telegram\Api\InputTypes\SetWebhook;
use Vashakidze\Telegram\Exceptions\TelegramApiException;
use Vashakidze\Telegram\Exceptions\TelegramArgsException;
use Vashakidze\Telegram\TelegramApi;

/**
 * Class TelegramCheckSetting
 * @package Vashakidze\Telegram\Console\Commands
 */
class TelegramCheckSetting extends Command
{
    /**
     * @var string
     */
    protected $signature = 'telegram:check-setting';

    /**
     * @var string
     */
    protected $description = 'Check env telegram setting';

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
            $this->checkApiSetting()->checkWebhookSetting();

            return self::SUCCESS;
        } catch (TelegramApiException $exception) {
            $this->error($exception->getDescription());

            return self::FAILURE;
        }
    }

    private function checkApiSetting(): ?self
    {
        $url = config('telegram.api.url');

        if (empty($url)) {
            $this->error("API URL has not set in config. Please set TELEGRAM_API_URL in .env file");

            return null;
        }

        $parsed = parse_url($url);

        if (empty($parsed) || !is_array($parsed) || empty($parsed['host']) || empty($parsed['scheme'])) {
            $this->error("API URL is incorrect. Please set correct TELEGRAM_API_URL in .env file");

            return null;
        }

        $token = config('telegram.api.token');

        if (empty($token)) {
            $this->error("API token has not set in config. Please set TELEGRAM_API_TOKEN in .env file");

            return null;
        }

        try {
            $bot = $this->api->getMe();
        } catch (TelegramApiException $e) {
            $this->error("API token or API URL is incorrect. " . $e->getDescription());

            return null;
        }

        $this->info("API setting is correct. Bot name: " . $bot->username);

        return $this;
    }

    private function checkWebhookSetting(): ?self
    {
        $url = config('telegram.webhook.url') ?? route('webhook.telegram');

        if (empty($url)) {
            $this->error("WebHook URL has not set in config. Please set TELEGRAM_WEBHOOK_URL");

            return null;
        }

        $parsed = parse_url($url);

        if (empty($parsed) || !is_array($parsed) || empty($parsed['host']) || empty($parsed['scheme'])) {
            $this->error("WebHook URL is incorrect. Please set correct TELEGRAM_WEBHOOK_URL in .env file");

            return null;
        }

        if ($parsed['scheme'] !== 'https') {
            $this->error("WebHook URL must be on HTTPS host");

            return null;
        }

        $token = config('telegram.webhook.token');

        if (empty($token)) {
            $this->warn("WebHook token has not set in config. We recommend installing a token for greater safety");

            $response = $this->choice(
                "Do you want to set WebHook token?",
                [
                    "Yes",
                    "No"
                ],
                "Yes"
            );

            if ($response === "Yes") {
                $this->info("Please set TELEGRAM_WEBHOOK_TOKEN in .env file and re-run this command. Recommend value: " . Str::random(30));

                return null;
            }
        }

        $query = [];

        if (!empty($parsed['query'])) {
            parse_str($parsed['query'], $query);
        }

        if (!empty($token)) {
            $query['token'] = $token;
        }

        $url = $parsed['scheme'] .
            "://" . $parsed['host'] .
            (!empty($parsed['port']) ? ":" . $parsed['port'] : "") .
            (!empty($parsed['path']) ? $parsed['path'] : "") .
            (!empty($query) ? "?" . http_build_query($query) : "");

        try {
            $webhookInfo = $this->api->getWebhookInfo();
        } catch (TelegramApiException $exception) {
            $this->error("Failed to check WebHook's settings. " . $exception->getDescription());

            return null;
        }

        if ($webhookInfo->url === '') {
            $response = $this->choice(
                "WebHook URL has not set in bot setting yet. Do you want to set it?",
                [
                    "Yes",
                    "No"
                ],
                "Yes"
            );

            if ($response === "No") {
                return $this;
            }

            return $this->setWebhookSetting($url);
        }

        if ($webhookInfo->url !== $url) {
            $response = $this->choice(
                "Webhook URL is incorrect: " . $webhookInfo->url . ". Do you want to set correct Webhook URL: " . $url . "?",
                [
                    "Yes",
                    "No"
                ],
                "Yes"
            );

            if ($response === "No") {
                return $this;
            }

            return $this->setWebhookSetting($url);
        }

        $this->info("Webhook setting is correct");

        return $this;
    }

    private function setWebhookSetting(string $url): ?self
    {
        try {
            $this->api->setWebhook(
                SetWebhook::args(
                    array_merge(
                        [
                            'url' => $url
                        ],
                        config('telegram.webhook.setting')
                    )
                )
            );
        } catch (TelegramApiException | TelegramArgsException $exception) {
            $this->error("Failed to set webhook info. " . $exception->getDescription());

            return null;
        }

        $this->info("Webhook URL was successfully set");

        return $this;
    }
}
