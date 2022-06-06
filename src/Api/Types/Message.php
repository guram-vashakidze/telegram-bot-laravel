<?php


namespace Vashakidze\Telegram\Api\Types;


use Carbon\Carbon;
use Illuminate\Support\Str;
use Vashakidze\Telegram\Api\Type;

use function array_key_exists;

/**
 * Class Message
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a message.
 *
 * @link https://core.telegram.org/bots/api#message
 *
 * @property-read int $messageId Unique message identifier inside this chat
 * @property-read User|null $from Sender of the message; empty for messages sent to channels. For backward compatibility, the field contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
 * @property-read Chat|null $senderChat Sender of the message, sent on behalf of a chat. For example, the channel itself for channel posts, the supergroup itself for messages from anonymous group administrators, the linked channel for messages automatically forwarded to the discussion group. For backward compatibility, the field from contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat
 * @property-read Carbon $date Date the message was sent in Unix time
 * @property-read Chat $chat Conversation the message belongs to
 * @property-read User|null $forwardFrom For forwarded messages, sender of the original message
 * @property-read Chat|null $forwardFromChat For messages forwarded from channels or from anonymous administrators, information about the original sender chat
 * @property-read int|null $forwardFromMessageId For messages forwarded from channels, identifier of the original message in the channel
 * @property-read string|null $forwardSignature For forwarded messages that were originally sent in channels or by an anonymous chat administrator, signature of the message sender if present
 * @property-read string|null $forwardSenderName Sender's name for messages forwarded from users who disallow adding a link to their account in forwarded messages
 * @property-read Carbon|null $forwardDate For forwarded messages, date the original message was sent in Unix time
 * @property-read bool|null $isAutomaticForward True, if the message is a channel post that was automatically forwarded to the connected discussion group
 * @property-read Message|null $replyToMessage For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply
 * @property-read User|null $viaBot Bot through which the message was sent
 * @property-read Carbon|null $editDate Date the message was last edited in Unix time
 * @property-read bool|null $hasProtectedContent True, if the message can't be forwarded
 * @property-read string|null $mediaGroupId The unique identifier of a media message group this message belongs to
 * @property-read string|null $authorSignature Signature of the post author for messages in channels, or the custom title of an anonymous group administrator
 * @property-read string|null $text For text messages, the actual UTF-8 text of the message, 0-4096 characters
 * @property-read MessageEntity[]|null $entities For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text
 * @property-read Animation|null $animation Message is an animation, information about the animation. For backward compatibility, when this field is set, the document field will also be set
 * @property-read Audio|null $audio Message is an audio file, information about the file
 * @property-read Document|null $document Message is a general file, information about the file
 * @property-read PhotoSize[]|null $photo Message is a photo, available sizes of the photo
 * @property-read Sticker|null $sticker Message is a sticker, information about the sticker
 * @property-read Video|null $video Message is a video, information about the video
 * @property-read VideoNote|null $videoNote Message is a video note, information about the video message
 * @property-read Voice|null $voice Message is a voice message, information about the file
 * @property-read string|null $caption Caption for the animation, audio, document, photo, video or voice, 0-1024 characters
 * @property-read MessageEntity[]|null $captionEntities For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption
 * @property-read Contact|null $contact Message is a shared contact, information about the contact
 * @property-read Dice|null $dice Message is a dice with random value
 * @property-read Game|null $game Message is a game, information about the game
 * @property-read Poll|null $poll Message is a native poll, information about the poll
 * @property-read Venue|null $venue Message is a venue, information about the venue. For backward compatibility, when this field is set, the location field will also be set
 * @property-read Location|null $location Message is a shared location, information about the location
 * @property-read User[]|null $newChatMembers New members that were added to the group or supergroup and information about them (the bot itself may be one of these members)
 * @property-read User|null $leftChatMember A member was removed from the group, information about them (this member may be the bot itself)
 * @property-read string|null $newChatTitle A chat title was changed to this value
 * @property-read PhotoSize[]|null $newChatPhoto A chat photo was change to this value
 * @property-read bool|null $deleteChatPhoto Service message: the chat photo was deleted
 * @property-read bool|null $groupChatCreated Service message: the group has been created
 * @property-read bool|null $supergroupChatCreated Service message: the supergroup has been created. This field can't be received in a message coming through updates, because bot can't be a member of a supergroup when it is created. It can only be found in reply_to_message if someone replies to a very first message in a directly created supergroup
 * @property-read bool|null $channelChatCreated Service message: the channel has been created. This field can't be received in a message coming through updates, because bot can't be a member of a channel when it is created. It can only be found in reply_to_message if someone replies to a very first message in a channel
 * @property-read MessageAutoDeleteTimerChanged|null $messageAutoDeleteTimerChanged Service message: auto-delete timer settings changed in the chat
 * @property-read int|null $migrateToChatId The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier
 * @property-read int|null $migrateFromChatId The supergroup has been migrated from a group with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier
 * @property-read Message|null $pinnedMessage Specified message was pinned. Note that the Message object in this field will not contain further reply_to_message fields even if it is itself a reply
 * @property-read Invoice|null $invoice Message is an invoice for a payment, information about the invoice
 * @property-read SuccessfulPayment|null $successfulPayment Message is a service message about a successful payment, information about the payment
 * @property-read string|null $connectedWebsite The domain name of the website on which the user has logged in
 * @property-read PassportData|null $passportData Telegram Passport data
 * @property-read ProximityAlertTriggered|null $proximityAlertTriggered Service message. A user in the chat triggered another user's proximity alert while sharing Live Location
 * @property-read VideoChatScheduled|null $videoChatScheduled Service message: video chat scheduled
 * @property-read VideoChatStarted|null $videoChatStarted Service message: video chat started
 * @property-read VideoChatEnded|null $videoChatEnded Service message: video chat ended
 * @property-read VideoChatParticipantsInvited|null $videoChatParticipantsInvited Service message: new participants invited to a video chat
 * @property-read WebAppData|null $webAppData Service message: data sent by a Web App
 * @property-read InlineKeyboardMarkup|null $replyMarkup Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons
 */
class Message extends Type
{
    protected int $messageId;
    protected ?User $from;
    protected ?Chat $senderChat;
    protected Carbon $date;
    protected Chat $chat;
    protected ?User $forwardFrom;
    protected ?Chat $forwardFromChat;
    protected ?int $forwardFromMessageId;
    protected ?string $forwardSignature;
    protected ?string $forwardSenderName;
    protected ?Carbon $forwardDate;
    protected ?bool $isAutomaticForward;
    protected ?Message $replyToMessage;
    protected ?User $viaBot;
    protected ?Carbon $editDate;
    protected ?bool $hasProtectedContent;
    protected ?string $mediaGroupId;
    protected ?string $authorSignature;
    protected ?string $text;
    protected ?array $entities;
    protected ?Animation $animation;
    protected ?Audio $audio;
    protected ?Document $document;
    protected ?array $photo;
    protected ?Sticker $sticker;
    protected ?Video $video;
    protected ?VideoNote $videoNote;
    protected ?Voice $voice;
    protected ?string $caption;
    protected ?array $captionEntities;
    protected ?Contact $contact;
    protected ?Dice $dice;
    protected ?Game $game;
    protected ?Poll $poll;
    protected ?Venue $venue;
    protected ?Location $location;
    protected ?array $newChatMembers;
    protected ?User $leftChatMember;
    protected ?string $newChatTitle;
    protected ?array $newChatPhoto;
    protected ?bool $deleteChatPhoto;
    protected ?bool $groupChatCreated;
    protected ?bool $supergroupChatCreated;
    protected ?bool $channelChatCreated;
    protected ?MessageAutoDeleteTimerChanged $messageAutoDeleteTimerChanged;
    protected ?int $migrateToChatId;
    protected ?int $migrateFromChatId;
    protected ?Message $pinnedMessage;
    protected ?Invoice $invoice;
    protected ?SuccessfulPayment $successfulPayment;
    protected ?string $connectedWebsite;
    protected ?PassportData $passportData;
    protected ?ProximityAlertTriggered $proximityAlertTriggered;
    protected ?VideoChatScheduled $videoChatScheduled;
    protected ?VideoChatStarted $videoChatStarted;
    protected ?VideoChatEnded $videoChatEnded;
    protected ?VideoChatParticipantsInvited $videoChatParticipantsInvited;
    protected ?WebAppData $webAppData;
    protected ?InlineKeyboardMarkup $replyMarkup;

    public static function init(array $data): self
    {
        $message = new self();
        $message->messageId = (int)$data['message_id'];
        $message->from = !empty($data['from']) ? User::init($data['from']) : null;
        $message->senderChat = !empty($data['sender_chat']) ? Chat::init($data['sender_chat']) : null;
        $message->date = Carbon::createFromTimestamp($data['date']);
        $message->chat = Chat::init($data['chat']);
        $message->forwardFrom = !empty($data['forward_from']) ? User::init($data['forward_from']) : null;
        $message->forwardFromChat = !empty($data['forward_from_chat']) ? Chat::init($data['forward_from_chat']) : null;
        $message->forwardFromMessageId = $data['forward_from_message_id'] ?? null;
        $message->forwardSignature = $data['forward_signature'] ?? null;
        $message->forwardSenderName = $data['forward_sender_name'] ?? null;
        $message->forwardDate = !empty($data['forward_date']) ? Carbon::createFromTimestamp($data['forward_date']) : null;
        $message->isAutomaticForward = $data['is_automatic_forward'] ?? null;
        $message->replyToMessage = !empty($data['reply_to_message']) ? self::init($data['reply_to_message']) : null;
        $message->viaBot = !empty($data['via_bot']) ? User::init($data['via_bot']) : null;
        $message->editDate = !empty($data['edit_date']) ? Carbon::createFromTimestamp($data['edit_date']) : null;
        $message->hasProtectedContent = $data['has_protected_content'] ?? null;
        $message->mediaGroupId = $data['media_group_id'] ?? null;
        $message->authorSignature = $data['author_signature'] ?? null;
        $message->text = $data['text'] ?? null;

        $message->setEntities($data, 'entities');

        $message->animation = !empty($data['animation']) ? Animation::init($data['animation']) : null;
        $message->audio = !empty($data['audio']) ? Audio::init($data['audio']) : null;
        $message->document = !empty($data['document']) ? Document::init($data['document']) : null;

        $message->setPhoto($data, 'photo');

        $message->sticker = !empty($data['sticker']) ? Sticker::init($data['sticker']) : null;
        $message->video = !empty($data['video']) ? Video::init($data['video']) : null;
        $message->videoNote = !empty($data['video_note']) ? VideoNote::init($data['video_note']) : null;
        $message->voice = !empty($data['voice']) ? Voice::init($data['voice']) : null;
        $message->caption = $data['caption'] ?? null;

        $message->setEntities($data, 'caption_entities');

        $message->contact = !empty($data['contact']) ? Contact::init($data['contact']) : null;
        $message->dice = !empty($data['dice']) ? Dice::init($data['dice']) : null;
        $message->game = !empty($data['game']) ? Game::init($data['game']) : null;
        $message->poll = !empty($data['poll']) ? Poll::init($data['poll']) : null;
        $message->venue = !empty($data['venue']) ? Venue::init($data['venue']) : null;
        $message->location = !empty($data['location']) ? Location::init($data['location']) : null;

        $message->setNewChatMembers($data);

        $message->leftChatMember = !empty($data['left_chat_member']) ? User::init($data['left_chat_member']) : null;
        $message->newChatTitle = $data['new_chat_title'] ?? null;

        $message->setPhoto($data, 'new_chat_photo');

        $message->deleteChatPhoto = $data['delete_chat_photo'] ?? null;
        $message->groupChatCreated = $data['group_chat_created'] ?? null;
        $message->supergroupChatCreated = $data['supergroup_chat_created'] ?? null;
        $message->channelChatCreated = $data['channel_chat_created'] ?? null;
        $message->messageAutoDeleteTimerChanged = !empty($data['message_auto_delete_timer_changed']) ? MessageAutoDeleteTimerChanged::init($data['message_auto_delete_timer_changed']) : null;
        $message->migrateToChatId = $data['migrate_to_chat_id'] ?? null;
        $message->migrateFromChatId = $data['migrate_from_chat_id'] ?? null;
        $message->pinnedMessage = !empty($data['pinned_message']) ? self::init($data['pinned_message']) : null;
        $message->successfulPayment = !empty($data['successful_payment']) ? SuccessfulPayment::init($data['successful_payment']) : null;
        $message->connectedWebsite = $data['connected_website'] ?? null;
        $message->passportData = !empty($data['passport_data']) ? PassportData::init($data['passport_data']) : null;
        $message->proximityAlertTriggered = !empty($data['proximity_alert_triggered']) ? ProximityAlertTriggered::init($data['proximity_alert_triggered']) : null;
        $message->videoChatScheduled = !empty($data['video_chat_scheduled']) ? VideoChatScheduled::init($data['video_chat_scheduled']) : null;
        $message->videoChatStarted = array_key_exists('video_chat_started',$data) ? VideoChatStarted::init([]) : null;
        $message->videoChatEnded = !empty($data['video_chat_ended']) ? VideoChatEnded::init($data['video_chat_ended']) : null;
        $message->videoChatParticipantsInvited = !empty($data['video_chat_participants_invited']) ? VideoChatParticipantsInvited::init($data['video_chat_participants_invited']) : null;
        $message->webAppData = !empty($data['web_app_data']) ? WebAppData::init($data['web_app_data']) : null;
        $message->replyMarkup = !empty($data['reply_markup']) ? InlineKeyboardMarkup::init($data['reply_markup']) : null;

        return $message;
    }

    private function setEntities(array $data, string $field): void
    {
        $propertyName = Str::camel($field);

        $this->{$propertyName} = null;

        if (empty($data[$field])) {
            return;
        }

        $this->{$propertyName} = [];

        foreach ($data[$field] as $entity) {
            $this->{$propertyName}[] = MessageEntity::init($entity);
        }
    }

    private function setPhoto(array $data, string $field): void
    {
        $propertyName = Str::camel($field);

        /**
         * @see Message::$newChatPhoto
         * @see Message::$photo
         */
        $this->{$propertyName} = null;

        if (empty($data[$field])) {
            return;
        }

        $this->{$propertyName} = [];

        foreach ($data[$field] as $photo) {
            $this->{$propertyName}[] = PhotoSize::init($photo);
        }
    }

    private function setNewChatMembers(array $data): void
    {
        $this->newChatMembers = null;

        if (empty($data['new_chat_members'])) {
            return;
        }

        $this->newChatMembers = [];

        foreach ($data['new_chat_members'] as $member) {
            $this->newChatMembers[] = User::init($member);
        }
    }
}
