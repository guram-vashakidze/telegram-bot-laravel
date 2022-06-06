<?php


namespace Vashakidze\Telegram\Api\InputTypes;


use JsonSerializable;
use Vashakidze\Telegram\Api\Enums\ParseMode;
use Vashakidze\Telegram\Api\InputType;
use Vashakidze\Telegram\Api\Types\ForceReply;
use Vashakidze\Telegram\Api\Types\InlineKeyboardMarkup;
use Vashakidze\Telegram\Api\Types\MessageEntity;
use Vashakidze\Telegram\Api\Types\ReplyKeyboardMarkup;
use Vashakidze\Telegram\Api\Types\ReplyKeyboardRemove;

/**
 * Class CopyMessage
 * @package Vashakidze\Telegram\Api\InputTypes
 *
 * Use this method to copy messages of any kind. Service messages and invoice messages can't be copied. The method is
 * analogous to the method forwardMessage, but the copied message doesn't have a link to the original message. Returns
 * the MessageId of the sent message on success
 *
 * @link https://core.telegram.org/bots/api#copymessage
 *
 * @property-read int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
 * @property-read int|string $fromChatId Unique identifier for the chat where the original message was sent (or channel username in the format @channelusername)
 * @property-read int $messageId Message identifier in the chat specified in from_chat_id
 * @property-read string|null $caption Text of the message to be sent, 1-4096 characters after entities parsing
 * @property-read ParseMode|null $parseMode Mode for parsing entities in the message text.
 * @property-read MessageEntity[]|null $captionEntities A JSON-serialized list of special entities that appear in message text, which can be specified instead of parse_mode
 * @property-read bool|null $disableNotification Sends the message silently. Users will receive a notification with no sound
 * @property-read bool|null $protectContent Protects the contents of the sent message from forwarding and saving
 * @property-read int|null $replyToMessageId If the message is a reply, ID of the original message
 * @property-read bool|null $allowSendingWithoutReply Pass True, if the message should be sent even if the specified replied-to message is not found
 * @property-read InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user
 *
 * @method self setChatId(int|string $chatId)
 * @method self setFromChatId(int|string $fromChatId)
 * @method self setMessageId(int $messageId)
 * @method self setCaption(string $caption)
 * @method self setParseMode(ParseMode $parseMode)
 * @method self setCaptionEntities(MessageEntity[] $captionEntities)
 * @method self setDisableNotification(bool $disableNotification = true)
 * @method self setProtectContent(bool $protectContent = true)
 * @method self setReplyToMessageId(int $replyToMessageId)
 * @method self setAllowSendingWithoutReply(bool $allowSendingWithoutReply = true)
 * @method self setReplyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup)
 */
class CopyMessage extends InputType
{
    protected int|string $chatId;
    protected int|string $fromChatId;
    protected int $messageId;
    protected ?string $caption;
    protected ?ParseMode $parseMode;
    protected array|JsonSerializable|null $captionEntities;
    protected ?bool $disableNotification;
    protected ?bool $protectContent;
    protected ?int $replyToMessageId;
    protected ?bool $allowSendingWithoutReply;
    protected InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup;
}
