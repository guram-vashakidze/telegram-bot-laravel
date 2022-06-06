<?php


namespace Vashakidze\Telegram\Api\Types;


use Carbon\Carbon;
use Vashakidze\Telegram\Api\Type;

/**
 * Class ChatInviteLink
 * @package Vashakidze\Telegram\Api\Types
 *
 * Represents an invite link for a chat
 *
 * @link https://core.telegram.org/bots/api#chatinvitelink
 *
 * @property-read string $inviteLink The invite link. If the link was created by another chat administrator, then the second part of the link will be replaced with “…”
 * @property-read User $creator Creator of the link
 * @property-read bool $createsJoinRequest True, if users joining the chat via the link need to be approved by chat administrators
 * @property-read bool $isPrimary True, if the link is primary
 * @property-read bool $isRevoked True, if the link is revoked
 * @property-read string|null $name Invite link name
 * @property-read Carbon|null $expireDate Point in time (Unix timestamp) when the link will expire or has been expired
 * @property-read int|null $memberLimit Maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999
 * @property-read int|null $pendingJoinRequestCount Number of pending join requests created using this link
 */
class ChatInviteLink extends Type
{
    protected string $inviteLink;
    protected User $creator;
    protected bool $createsJoinRequest;
    protected bool $isPrimary;
    protected bool $isRevoked;
    protected ?string $name;
    protected ?Carbon $expireDate;
    protected ?int $memberLimit;
    protected ?int $pendingJoinRequestCount;

    public static function init(array $data): self
    {
        $invite = new self();

        $invite->inviteLink = $data['invite_link'];
        $invite->creator = User::init($data['creator']);
        $invite->createsJoinRequest = $data['creates_join_request'];
        $invite->isPrimary = $data['is_primary'];
        $invite->isRevoked = $data['is_revoked'];
        $invite->name = $data['name'] ?? null;
        $invite->expireDate = !empty($data['expire_date']) ? Carbon::createFromTimestamp($data['expire_date']) : null;
        $invite->memberLimit = $data['member_limit'] ?? null;
        $invite->pendingJoinRequestCount = $data['pending_join_request_count'] ?? null;

        return $invite;
    }
}
