<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Api\Enums\ChatMemberStatus;

/**
 * Class ChatMemberAdministrator
 * @package Vashakidze\Telegram\Api\Types
 *
 * Represents a chat member that owns the chat and has all administrator privileges
 *
 * @link https://core.telegram.org/bots/api#chatmember
 *
 * @property-read ChatMemberStatus $status The member's status in the chat, always “administrator”
 * @property-read User $user Information about the user
 * @property-read bool $isAnonymous True, if the user's presence in the chat is hidden
 * @property-read bool $canBeEdited True, if the bot is allowed to edit administrator privileges of that user
 * @property-read bool $canManageChat True, if the administrator can access the chat event log, chat statistics, message statistics in channels, see channel members, see anonymous administrators in supergroups and ignore slow mode. Implied by any other administrator privilege
 * @property-read bool $canDeleteMessages True, if the administrator can delete messages of other users
 * @property-read bool $canManageVideoChats True, if the administrator can manage video chats
 * @property-read bool $canRestrictMembers True, if the administrator can restrict, ban or unban chat members
 * @property-read bool $canPromoteMembers True, if the administrator can add new administrators with a subset of their own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by the user)
 * @property-read bool $canChangeInfo True, if the user is allowed to change the chat title, photo and other settings
 * @property-read bool $canInviteUsers True, if the user is allowed to invite new users to the chat
 * @property-read bool|null $canPostMessages True, if the administrator can post in the channel; channels only
 * @property-read bool|null $canEditMessages True, if the administrator can edit messages of other users and can pin messages; channels only
 * @property-read bool|null $canPinMessages True, if the user is allowed to pin messages; groups and supergroups only
 * @property-read string|null $customTitle Custom title for this user
 */
class ChatMemberAdministrator extends Type
{
    protected ChatMemberStatus $status;
    protected User $user;
    protected bool $isAnonymous;
    protected bool $canBeEdited;
    protected bool $canManageChat;
    protected bool $canDeleteMessages;
    protected bool $canManageVideoChats;
    protected bool $canRestrictMembers;
    protected bool $canPromoteMembers;
    protected bool $canChangeInfo;
    protected bool $canInviteUsers;
    protected ?bool $canPostMessages;
    protected ?bool $canEditMessages;
    protected ?bool $canPinMessages;
    protected ?string $customTitle;

    public static function init(array $data): self
    {
        $administrator = new self();

        $administrator->status = ChatMemberStatus::fromValue($data['status']);
        $administrator->user = User::init($data['user']);
        $administrator->isAnonymous = $data['is_anonymous'];
        $administrator->canBeEdited = $data['can_be_edited'];
        $administrator->canManageChat = $data['can_manage_chat'];
        $administrator->canDeleteMessages = $data['can_delete_messages'];
        $administrator->canManageVideoChats = $data['can_manage_video_chats'];
        $administrator->canRestrictMembers = $data['can_restrict_members'];
        $administrator->canPromoteMembers = $data['can_promote_members'];
        $administrator->canChangeInfo = $data['can_change_info'];
        $administrator->canInviteUsers = $data['can_invite_users'];
        $administrator->canPostMessages = $data['can_post_messages'] ?? null;
        $administrator->canEditMessages = $data['can_edit_messages'] ?? null;
        $administrator->canPinMessages = $data['can_pin_messages'] ?? null;
        $administrator->customTitle = $data['custom_title'] ?? null;

        return $administrator;
    }
}
