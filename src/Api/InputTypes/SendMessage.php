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
 * Class SendMessage
 * @package Vashakidze\Telegram\Api\InputTypes
 *
 * Use this method to send text messages. On success, the sent Message is returned
 *
 * @link https://core.telegram.org/bots/api#sendmessage
 *
 * @property-read int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
 * @property-read string $text Text of the message to be sent, 1-4096 characters after entities parsing
 * @property-read ParseMode|null $parseMode Mode for parsing entities in the message text.
 * @property-read MessageEntity[]|null $entities A JSON-serialized list of special entities that appear in message text, which can be specified instead of parse_mode
 * @property-read bool|null $disableWebPagePreview Disables link previews for links in this message
 * @property-read bool|null $disableNotification Sends the message silently. Users will receive a notification with no sound
 * @property-read bool|null $protectContent Protects the contents of the sent message from forwarding and saving
 * @property-read int|null $replyToMessageId If the message is a reply, ID of the original message
 * @property-read bool|null $allowSendingWithoutReply Pass True, if the message should be sent even if the specified replied-to message is not found
 * @property-read InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user
 *
 * @method self setChatId(int|string $chatId)
 * @method self setText(string $text)
 * @method self setParseMode(ParseMode $parseMode)
 * @method self setEntities(MessageEntity[] $entities)
 * @method self setDisableWebPagePreview(bool $disableWebPagePreview = true)
 * @method self setDisableNotification(bool $disableNotification = true)
 * @method self setProtectContent(bool $protectContent = true)
 * @method self setReplyToMessageId(int $replyToMessageId)
 * @method self setAllowSendingWithoutReply(bool $allowSendingWithoutReply = true)
 * @method self setReplyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup)
 */
class SendMessage extends InputType
{
    protected int|string $chatId;
    protected string $text;
    protected ?ParseMode $parseMode;
    protected array|JsonSerializable|null $entities;
    protected ?bool $disableWebPagePreview;
    protected ?bool $disableNotification;
    protected ?bool $protectContent;
    protected ?int $replyToMessageId;
    protected ?bool $allowSendingWithoutReply;
    protected InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup;
}
