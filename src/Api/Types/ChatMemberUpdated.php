<?php


namespace Vashakidze\Telegram\Api\Types;


use Carbon\Carbon;
use Vashakidze\Telegram\Api\Type;

/**
 * Class ChatMemberUpdated
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents changes in the status of a chat member
 *
 * @link https://core.telegram.org/bots/api#chatmemberupdated
 *
 * @property-read Chat $chat Chat the user belongs to
 * @property-read User $from Performer of the action, which resulted in the change
 * @property-read Carbon $date Date the change was done
 * @property-read ChatMember $oldChatMember Previous information about the chat member
 * @property-read ChatMember $newChatMember New information about the chat member
 * @property-read ChatInviteLink|null $inviteLink Chat invite link, which was used by the user to join the chat; for joining by invite link events only
 */
class ChatMemberUpdated extends Type
{
    protected Chat $chat;
    protected User $from;
    protected Carbon $date;
    protected ChatMember $oldChatMember;
    protected ChatMember $newChatMember;
    protected ?ChatInviteLink $inviteLink;

    public static function init(array $data): self
    {
        $chatMemberUpdated = new self();

        $chatMemberUpdated->chat = Chat::init($data['chat']);
        $chatMemberUpdated->from = User::init($data['from']);
        $chatMemberUpdated->date = Carbon::createFromTimestamp($data['date']);
        $chatMemberUpdated->oldChatMember = ChatMember::init($data['old_chat_member']);
        $chatMemberUpdated->newChatMember = ChatMember::init($data['new_chat_member']);
        $chatMemberUpdated->inviteLink = !empty($data['invite_link']) ? ChatInviteLink::init($data['invite_link']) : null;

        return $chatMemberUpdated;
    }
}
