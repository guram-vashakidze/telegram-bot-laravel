<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Api\Enums\ChatMemberStatus;

/**
 * Class ChatMemberOwner
 * @package Vashakidze\Telegram\Api\Types
 *
 * Represents a chat member that owns the chat and has all administrator privileges
 *
 * @link https://core.telegram.org/bots/api#chatmember
 *
 * @property-read ChatMemberStatus $status The member's status in the chat, always “creator”
 * @property-read User $user Information about the user
 * @property-read bool $isAnonymous True, if the user's presence in the chat is hidden
 * @property-read string|null $customTitle Custom title for this user
 */
class ChatMemberOwner extends Type
{
    protected ChatMemberStatus $status;
    protected User $user;
    protected bool $isAnonymous;
    protected ?string $customTitle;

    public static function init(array $data): self
    {
        $owner = new self();

        $owner->status = ChatMemberStatus::fromValue($data['status']);
        $owner->user = User::init($data['user']);
        $owner->isAnonymous = $data['is_anonymous'];
        $owner->customTitle = $data['custom_title'] ?? null;

        return $owner;
    }
}
