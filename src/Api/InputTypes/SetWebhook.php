<?php


namespace Vashakidze\Telegram\Api\InputTypes;


use Vashakidze\Telegram\Api\InputType;
use Vashakidze\Telegram\Api\Enums\WebhookUpdateType;
use Vashakidze\Telegram\Exceptions\TelegramArgsException;

/**
 * Class SetWebhook
 * @package Vashakidze\Telegram\Api\InputTypes
 *
 * @link https://core.telegram.org/bots/api#setwebhook
 *
 * @property string $url HTTPS url to send updates to. Use an empty string to remove webhook integration
 * @property InputFile|null $certificate Upload your public key certificate so that the root certificate in use can be checked. See our self-signed guide for details
 * @property string|null $ipAddress The fixed IP address which will be used to send webhook requests instead of the IP address resolved through DNS
 * @property int|null $maxConnections Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100. Defaults to 40. Use lower values to limit the load on your bot's server, and higher values to increase your bot's throughput
 * @property array|null $allowedUpdates A JSON-serialized list of the update types you want your bot to receive. For example, specify [“message”, “edited_channel_post”, “callback_query”] to only receive updates of these types. See Update for a complete list of available update types. Specify an empty list to receive all update types except chat_member (default). If not specified, the previous setting will be used.
 * @property bool|null $dropPendingUpdates Pass True to drop all pending updates
 *
 */
class SetWebhook extends InputType
{
    protected string $url;
    protected ?InputFile $certificate;
    protected ?string $ipAddress;
    protected ?int $maxConnections;
    protected ?array $allowedUpdates;
    protected ?bool $dropPendingUpdates;

    /**
     * @param InputFile $certificate
     * @return $this
     */
    public function setCertificate(InputFile $certificate): self
    {
        $this->certificate = $certificate->setName('certificate');

        return $this;
    }

    /**
     * @param array $allowedUpdates
     * @return $this
     * @throws TelegramArgsException
     */
    public function setAllowedUpdates(array $allowedUpdates): self
    {
        $allowedUpdates = array_values(array_unique($allowedUpdates));
        $allList = WebhookUpdateType::getValues();

        foreach ($allowedUpdates as $item) {
            if (!in_array($item, $allList)) {
                throw new TelegramArgsException("You set incorrect allowed_updates field. Field: " . $item);
            }
        }

        $this->allowedUpdates = $allowedUpdates;

        return $this;
    }
}
