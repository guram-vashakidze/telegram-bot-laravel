<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class ChatPermissions
 * @package Vashakidze\Telegram\Api\Types
 *
 * Describes actions that a non-administrator user is allowed to take in a chat
 *
 * @link https://core.telegram.org/bots/api#chatpermissions
 *
 * @property-read bool|null $canSendMessage - True, if the user is allowed to send text messages, contacts, locations and venues
 * @property-read bool|null $canSendMediaMessage - True, if the user is allowed to send audios, documents, photos, videos, video notes and voice notes, implies can_send_messages
 * @property-read bool|null $canSendPolls - True, if the user is allowed to send polls, implies can_send_messages
 * @property-read bool|null $canSendOtherMessages - True, if the user is allowed to send animations, games, stickers and use inline bots, implies can_send_media_messages
 * @property-read bool|null $canAddWebPagePreviews - True, if the user is allowed to add web page previews to their messages, implies can_send_media_messages
 * @property-read bool|null $canChangeInfo - True, if the user is allowed to change the chat title, photo and other settings. Ignored in public supergroups
 * @property-read bool|null $canInviteUsers - True, if the user is allowed to invite new users to the chat
 * @property-read bool|null $canPinMessages - True, if the user is allowed to pin messages. Ignored in public supergroups
 */
class ChatPermissions extends Type
{
    protected ?bool $canSendMessage;
    protected ?bool $canSendMediaMessage;
    protected ?bool $canSendPolls;
    protected ?bool $canSendOtherMessages;
    protected ?bool $canAddWebPagePreviews;
    protected ?bool $canChangeInfo;
    protected ?bool $canInviteUsers;
    protected ?bool $canPinMessages;

    public static function init(array $data): self
    {
        $chatPermissions = new self();

        $chatPermissions->canSendMessage = $data['can_send_messages'] ?? null;
        $chatPermissions->canSendMediaMessage = $data['can_send_messages'] ?? null;
        $chatPermissions->canSendPolls = $data['can_send_polls'] ?? null;
        $chatPermissions->canSendOtherMessages = $data['can_send_other_messages'] ?? null;
        $chatPermissions->canAddWebPagePreviews = $data['can_add_web_page_previews'] ?? null;
        $chatPermissions->canChangeInfo = $data['can_change_info'] ?? null;
        $chatPermissions->canInviteUsers = $data['can_invite_users'] ?? null;
        $chatPermissions->canPinMessages = $data['can_pin_messages'] ?? null;

        return $chatPermissions;
    }
}
