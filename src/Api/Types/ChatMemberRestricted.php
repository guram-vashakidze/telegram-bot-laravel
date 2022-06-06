<?php


namespace Vashakidze\Telegram\Api\Types;


use Carbon\Carbon;
use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Api\Enums\ChatMemberStatus;

/**
 * Class ChatMemberRestricted
 * @package Vashakidze\Telegram\Api\Types
 *
 * Represents a chat member that is under certain restrictions in the chat. Supergroups only
 *
 * @link https://core.telegram.org/bots/api#chatmemberrestricted
 *
 * @property-read ChatMemberStatus $status The member's status in the chat, always “restricted”
 * @property-read User $user Information about the user
 * @property-read bool $isMember True, if the user is a member of the chat at the moment of the request
 * @property-read bool $canChangeInfo True, if the user is allowed to change the chat title, photo and other settings
 * @property-read bool $canInviteUsers True, if the user is allowed to invite new users to the chat
 * @property-read bool $canPinMessages True, if the user is allowed to pin messages; groups and supergroups only
 * @property-read bool $canSendMessages True, if the user is allowed to send text messages, contacts, locations and venues
 * @property-read bool $canSendMediaMessages True, if the user is allowed to send audios, documents, photos, videos, video notes and voice notes
 * @property-read bool $canSendPolls True, if the user is allowed to send polls
 * @property-read bool $canSendOtherMessage True, if the user is allowed to send animations, games, stickers and use inline bots
 * @property-read bool $canAddWebPagePreviews True, if the user is allowed to add web page previews to their messages
 * @property-read Carbon|null $untilDate Date when restrictions will be lifted for this user; unix time. If 0, then the user is restricted forever
 */
class ChatMemberRestricted extends Type
{
    protected ChatMemberStatus $status;
    protected User $user;
    protected bool $isMember;
    protected bool $canChangeInfo;
    protected bool $canInviteUsers;
    protected bool $canPinMessages;
    protected bool $canSendMessages;
    protected bool $canSendMediaMessages;
    protected bool $canSendPolls;
    protected bool $canSendOtherMessage;
    protected bool $canAddWebPagePreviews;
    protected ?Carbon $untilDate;

    public static function init(array $data): self
    {
        $restricted = new self();

        $restricted->status = ChatMemberStatus::fromValue($data['status']);
        $restricted->user = User::init($data['user']);
        $restricted->isMember = $data['is_member'];
        $restricted->canChangeInfo = $data['can_change_info'];
        $restricted->canInviteUsers = $data['can_invite_users'];
        $restricted->canPinMessages = $data['can_pin_messages'] ?? null;
        $restricted->canSendMessages = $data['can_send_messages'] ?? null;
        $restricted->canSendMediaMessages = $data['can_send_media_messages'] ?? null;
        $restricted->canSendPolls = $data['can_send_polls'] ?? null;
        $restricted->canSendOtherMessage = $data['can_send_other_message'] ?? null;
        $restricted->canAddWebPagePreviews = $data['can_send_web_page_previews'] ?? null;
        $restricted->untilDate = !empty($data['until_date']) ? Carbon::createFromTimestamp($data['until_date']) : null;

        return $restricted;
    }
}
