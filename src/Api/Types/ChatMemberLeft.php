<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Api\Enums\ChatMemberStatus;

/**
 * Class ChatMemberLeft
 * @package Vashakidze\Telegram\Api\Types
 *
 * Represents a chat member that isn't currently a member of the chat, but may join it themselves
 *
 * @link https://core.telegram.org/bots/api#chatmemberleft
 *
 * @property-read ChatMemberStatus $status The member's status in the chat, always “left”
 * @property-read User $user Information about the user
 */
class ChatMemberLeft extends Type
{
    protected ChatMemberStatus $status;
    protected User $user;

    public static function init(array $data): self
    {
        $left = new self();

        $left->status = ChatMemberStatus::fromValue($data['status']);
        $left->user = User::init($data['user']);

        return $left;
    }
}
