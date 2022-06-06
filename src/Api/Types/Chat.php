<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Api\Enums\ChatType;

/**
 * Class Chat
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a chat
 *
 * @link https://core.telegram.org/bots/api#chat
 *
 * @property-read int $id - Unique identifier for this chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
 * @property-read ChatType $type - Type of chat, can be either “private”, “group”, “supergroup” or “channel”
 * @property-read string|null $title - Title, for supergroups, channels and group chats
 * @property-read string|null $username - Username, for private chats, supergroups and channels if available
 * @property-read string|null $firstName - First name of the other party in a private chat
 * @property-read string|null $lastName - Last name of the other party in a private chat
 * @property-read ChatPhoto|null $photo - Chat photo. Returned only in "getChat"
 * @property-read string|null $bio - Bio of the other party in a private chat. Returned only in "getChat"
 * @property-read bool|null $hasPrivateForwards - True, if privacy settings of the other party in the private chat allows to use tg://user?id=<user_id> links only in chats with the user. Returned only in "getChat"
 * @property-read string|null $description - Description, for groups, supergroups and channel chats. Returned only in "getChat"
 * @property-read string|null $inviteLink - Primary invite link, for groups, supergroups and channel chats. Returned only in "getChat"
 * @property-read Message|null $pinnedMessage - The most recent pinned message (by sending date). Returned only in "getChat"
 * @property-read ChatPermissions|null $permissions - Default chat member permissions, for groups and supergroups. Returned only in "getChat"
 * @property-read int|null $slowModeDelay - For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user; in seconds. Returned only in "getChat"
 * @property-read int|null $messageAutoDeleteTime - The time after which all messages sent to the chat will be automatically deleted; in seconds. Returned only in "getChat"
 * @property-read bool|null $hasProtectedContent - True, if messages from the chat can't be forwarded to other chats. Returned only in "getChat"
 * @property-read string|null $stickerSetName - For supergroups, name of group sticker set. Returned only in "getChat"
 * @property-read bool|null $canSetStickerSet - True, if the bot can change the group sticker set. Returned only in "getChat"
 * @property-read int|null $linkedChatId -  Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice versa; for supergroups and channel chats. This identifier may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier. Returned only in "getChat"
 * @property-read ChatLocation|null $location - For supergroups, the location to which the supergroup is connected. Returned only in "getChat"
 */
class Chat extends Type
{
    protected int $id;
    protected ChatType $type;
    protected ?string $title;
    protected ?string $username;
    protected ?string $firstName;
    protected ?string $lastName;
    protected ?ChatPhoto $photo = null;
    protected ?string $bio;
    protected ?bool $hasPrivateForwards;
    protected ?string $description;
    protected ?string $inviteLink;
    protected ?Message $pinnedMessage = null;
    protected ?ChatPermissions $permissions = null;
    protected ?int $slowModeDelay;
    protected ?int $messageAutoDeleteTime;
    protected ?bool $hasProtectedContent;
    protected ?string $stickerSetName;
    protected ?bool $canSetStickerSet;
    protected ?int $linkedChatId;
    protected ?ChatLocation $location = null;

    public static function init(array $data): self
    {
        $chat = new self();

        $chat->id = (int)$data['id'];
        $chat->type = ChatType::fromValue($data['type']);
        $chat->title = $data['title'] ?? null;
        $chat->username = $data['username'] ?? null;
        $chat->firstName = $data['first_name'] ?? null;
        $chat->lastName = $data['last_name'] ?? null;

        if (array_key_exists('photo', $data)) {
            $chat->photo = ChatPhoto::init($data['photo']);
        }

        $chat->bio = $data['bio'] ?? null;
        $chat->hasPrivateForwards = $data['has_private_forwards'] ?? null;
        $chat->description = $data['description'] ?? null;
        $chat->inviteLink = $data['invite_link'] ?? null;

        if (array_key_exists('pinned_message', $data)) {
            $chat->pinnedMessage = Message::init($data['pinned_message']);
        }

        if (array_key_exists('permissions', $data)) {
            $chat->pinnedMessage = ChatPermissions::init($data['permissions']);
        }
        $chat->slowModeDelay = $data['slow_mode_delay'] ?? null;
        $chat->messageAutoDeleteTime = $data['message_auto_delete_time'] ?? null;
        $chat->hasProtectedContent = $data['has_protected_content'] ?? null;
        $chat->stickerSetName = $data['sticker_set_name'] ?? null;
        $chat->canSetStickerSet = $data['can_set_sticker_set'] ?? null;
        $chat->linkedChatId = $data['linked_chat_id'] ?? null;

        if (array_key_exists('location', $data)) {
            $chat->location = ChatLocation::init($data['location']);
        }

        return $chat;
    }
}
