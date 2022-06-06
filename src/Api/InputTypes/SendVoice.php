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
 * Class SendVoice
 * @package Vashakidze\Telegram\Api\InputTypes
 *
 * @link https://core.telegram.org/bots/api#sendvoice
 *
 * @property-read int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
 * @property-read InputFile|string $voice Audio file to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data
 * @property-read string|null $caption Photo caption (may also be used when resending voices by file_id), 0-1024 characters after entities parsing
 * @property-read ParseMode|null $parseMode Mode for parsing entities in the message text.
 * @property-read MessageEntity[]|null $captionEntities A JSON-serialized list of special entities that appear in message text, which can be specified instead of parse_mode
 * @property-read int|null $duration Duration of the voice in seconds
 * @property-read bool|null $disableNotification Sends the message silently. Users will receive a notification with no sound
 * @property-read bool|null $protectContent Protects the contents of the sent message from forwarding and saving
 * @property-read int|null $replyToMessageId If the message is a reply, ID of the original message
 * @property-read bool|null $allowSendingWithoutReply Pass True, if the message should be sent even if the specified replied-to message is not found
 * @property-read InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user
 *
 * @method self setChatId(int|string $chatId)
 * @method self setCaption(string $caption)
 * @method self setParseMode(ParseMode $parseMode)
 * @method self setCaptionEntities(MessageEntity[] $captionEntities)
 * @method self setDuration(int $duration)
 * @method self setDisableNotification(bool $disableNotification = true)
 * @method self setProtectContent(bool $protectContent = true)
 * @method self setReplyToMessageId(int $replyToMessageId)
 * @method self setAllowSendingWithoutReply(bool $allowSendingWithoutReply = true)
 * @method self setReplyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup)
 */
class SendVoice extends InputType
{
    protected int|string $chatId;
    protected InputFile|string $voice;
    protected ?string $caption;
    protected ?ParseMode $parseMode;
    protected array|JsonSerializable|null $captionEntities;
    protected ?int $duration;
    protected ?bool $disableNotification;
    protected ?bool $protectContent;
    protected ?int $replyToMessageId;
    protected ?bool $allowSendingWithoutReply;
    protected InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup;

    public function setVoice(InputFile|string $voice): self
    {
        if ($voice instanceof InputFile) {
            $this->voice = $voice->setName('voice');

            return $this;
        }

        $this->voice = $voice;
        return $this;
    }
}
