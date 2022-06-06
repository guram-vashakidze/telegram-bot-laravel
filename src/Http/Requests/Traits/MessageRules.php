<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait MessageRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#message
 */
trait MessageRules
{
    use RulesHelper;
    use UserRules;
    use ChatRules;
    use MessageEntityRules;
    use InlineKeyboardMarkupRules;
    use AnimationRules;
    use AudioRules;
    use DocumentRules;
    use PhotoSizeRules;
    use StickerRules;
    use VideoRules;
    use VideoNoteRules;
    use VoiceRules;
    use ContactRules;
    use DiceRules;
    use GameRules;
    use PollRules;
    use VenueRules;
    use LocationRules;
    use MessageAutoDeleteTimerChangedRules;
    use InvoiceRules;
    use SuccessfulPaymentRules;
    use PassportDataRules;
    use ProximityAlertTriggeredRules;
    use VideoChatScheduledRules;
    use VideoChatEndedRules;
    use VideoChatParticipantsInvitedRules;
    use WebAppDataRules;

    protected function getMessageRules(?string $prefix = null): array
    {
        if ($this->isRepeat($prefix)) {
            return [];
        }

        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'message_id' => [
                    $required,
                    'int',
                ],
                $prefix . 'from' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'sender_chat' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'date' => [
                    $required,
                    'integer',
                ],
                $prefix . 'chat' => [
                    $required,
                    'array',
                ],
                $prefix . 'forward_from' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'forward_from_chat' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'forward_from_message_id' => [
                    'nullable',
                    'int'
                ],
                $prefix . 'forward_signature' => [
                    'nullable',
                    'string'
                ],
                $prefix . 'forward_sender_name' => [
                    'nullable',
                    'string'
                ],
                $prefix . 'forward_date' => [
                    'nullable',
                    'int'
                ],
                $prefix . 'is_automatic_forward' => [
                    'nullable',
                    'boolean'
                ],
                $prefix . 'reply_to_message' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'via_bot' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'edit_date' => [
                    'nullable',
                    'int',
                ],
                $prefix . 'has_protected_content' => [
                    'nullable',
                    'boolean'
                ],
                $prefix . 'media_group_id' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'author_signature' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'text' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'entities' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'animation' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'audio' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'document' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'photo' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'sticker' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'video' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'video_note' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'voice' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'caption' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'caption_entities' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'contact' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'dice' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'game' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'poll' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'venue' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'location' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'new_chat_members' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'left_chat_member' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'new_chat_title' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'new_chat_photo' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'delete_chat_photo' => [
                    'nullable',
                    'bool',
                ],
                $prefix . 'group_chat_created' => [
                    'nullable',
                    'bool',
                ],
                $prefix . 'supergroup_chat_created' => [
                    'nullable',
                    'bool',
                ],
                $prefix . 'channel_chat_created' => [
                    'nullable',
                    'bool',
                ],
                $prefix . 'message_auto_delete_timer_changed' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'migrate_to_chat_id' => [
                    'nullable',
                    'int',
                ],
                $prefix . 'migrate_from_chat_id' => [
                    'nullable',
                    'int',
                ],
                $prefix . 'pinned_message' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'invoice' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'successful_payment' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'connected_website' => [
                    'nullable',
                    'string'
                ],
                $prefix . 'passport_data' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'proximity_alert_triggered' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'video_chat_scheduled' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'video_chat_started' => [
                    'nullable',
                ],
                $prefix . 'video_chat_ended' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'video_chat_participants_invited' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'web_app_data' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'reply_markup' => [
                    'nullable',
                    'array'
                ]
            ],
            $this->getUserRules($prefix . 'from'),
            $this->getChatRules($prefix . 'sender_chat'),
            $this->getChatRules($prefix . 'chat'),
            $this->getUserRules($prefix . 'forward_from'),
            $this->getChatRules($prefix . 'forward_from_chat'),
            $this->getMessageRules($prefix . 'reply_to_message'),
            $this->getUserRules($prefix . 'via_bot'),
            $this->getMessageEntityRules($prefix . 'entities.*'),
            $this->getAnimationRules($prefix . 'animation'),
            $this->getAudioRules($prefix . 'audio'),
            $this->getDocumentRules($prefix . 'document'),
            $this->getPhotoSizeRules($prefix . 'photo.*'),
            $this->getStickerRules($prefix . 'sticker'),
            $this->getVideoRules($prefix . 'video'),
            $this->getVideoNoteRules($prefix . 'video_note'),
            $this->getVoiceRules($prefix . 'voice'),
            $this->getMessageEntityRules($prefix . 'caption_entities.*'),
            $this->getContactRules($prefix . 'contact'),
            $this->getDiceRules($prefix . 'dice'),
            $this->getGameRules($prefix . 'game'),
            $this->getPollRules($prefix . 'poll'),
            $this->getVenueRules($prefix . 'venue'),
            $this->getLocationRules($prefix . 'location'),
            $this->getUserRules($prefix . 'new_chat_members.*'),
            $this->getUserRules($prefix . 'left_chat_member'),
            $this->getPhotoSizeRules($prefix . 'new_chat_photo.*'),
            $this->getMessageAutoDeleteTimerChangedRules($prefix . 'message_auto_delete_timer_changed'),
            $this->getMessageRules($prefix . 'pinned_message'),
            $this->getInvoiceRules($prefix . 'invoice'),
            $this->getSuccessfulPaymentRules($prefix . 'successful_payment'),
            $this->getPassportDataRules($prefix . 'passport_data'),
            $this->getProximityAlertTriggeredRules($prefix . 'proximity_alert_triggered'),
            $this->getVideoChatScheduledRules($prefix . 'video_chat_scheduled'),
            $this->getVideoChatEndedRules($prefix . 'video_chat_ended'),
            $this->getVideoChatParticipantsInvitedRules($prefix . 'video_chat_participants_invited'),
            $this->getWebAppDataRules($prefix . 'web_app_data'),
            $this->getInlineKeyboardMarkupRules($prefix . 'reply_markup')
        );
    }
}
