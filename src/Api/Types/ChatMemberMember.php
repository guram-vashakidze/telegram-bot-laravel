<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Api\Enums\ChatMemberStatus;

/**
 * Class ChatMemberMember
 * @package Vashakidze\Telegram\Api\Types
 *
 * Represents a chat member that has no additional privileges or restrictions
 *
 * @link https://core.telegram.org/bots/api#chatmembermember
 *
 * @property-read ChatMemberStatus $status The member's status in the chat, always “member”
 * @property-read User $user Information about the user
 */
class ChatMemberMember extends Type
{
    protected ChatMemberStatus $status;
    protected User $user;

    public static function init(array $data): self
    {
        $mamber = new self();

        $mamber->status = ChatMemberStatus::fromValue($data['status']);
        $mamber->user = User::init($data['user']);

        return $mamber;
    }
}
