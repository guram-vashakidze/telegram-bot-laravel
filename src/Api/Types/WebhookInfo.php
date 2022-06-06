<?php


namespace Vashakidze\Telegram\Api\Types;


use Carbon\Carbon;
use Vashakidze\Telegram\Api\Type;

/**
 * Class WebhookInfo
 * @package Vashakidze\Telegram\Api\Types
 *
 * Contains information about the current status of a webhook
 *
 * @link https://core.telegram.org/bots/api#webhookinfo
 *
 * @property-read string $url Webhook URL, may be empty if webhook is not set up
 * @property-read bool $hasCustomCertificate True, if a custom certificate was provided for webhook certificate checks
 * @property-read int $pendingUpdateCount Number of updates awaiting delivery
 * @property-read string|null $ipAddress Currently used webhook IP address
 * @property-read Carbon|null $lastErrorDate Unix time for the most recent error that happened when trying to deliver an update via webhook
 * @property-read string|null $lastErrorMessage Error message in human-readable format for the most recent error that happened when trying to deliver an update via webhook
 * @property-read Carbon|null $lastSynchronizationErrorDate Unix time of the most recent error that happened when trying to synchronize available updates with Telegram datacenters
 * @property-read int|null $maxConnections Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery
 * @property-read array|null $allowedUpdates A list of update types the bot is subscribed to. Defaults to all update types except chat_member
 */
class WebhookInfo extends Type
{
    protected string $url;
    protected bool $hasCustomCertificate;
    protected int $pendingUpdateCount;
    protected ?string $ipAddress;
    protected ?Carbon $lastErrorDate;
    protected ?string $lastErrorMessage;
    protected ?Carbon $lastSynchronizationErrorDate;
    protected ?int $maxConnections;
    protected ?array $allowedUpdates;

    public static function init(array $data): self
    {
        $webhookInfo = new self();

        $webhookInfo->url = data_get($data, 'url');
        $webhookInfo->hasCustomCertificate = $data['has_custom_certificate'];
        $webhookInfo->pendingUpdateCount = $data['pending_update_count'];
        $webhookInfo->ipAddress = $data['ip_address'] ?? null;
        $webhookInfo->lastErrorDate = !empty($data['last_error_data']) ? Carbon::createFromTimestamp($data['last_error_data']) : null;
        $webhookInfo->lastErrorMessage = $data['last_error_message'] ?? null;
        $webhookInfo->lastSynchronizationErrorDate = !empty($data['last_synchronization_error_date']) ? Carbon::createFromTimestamp($data['last_synchronization_error_date']) : null;
        $webhookInfo->maxConnections = $data['max_connections'] ?? null;
        $webhookInfo->allowedUpdates = $data['allowed_updates'] ?? null;

        return $webhookInfo;
    }
}
