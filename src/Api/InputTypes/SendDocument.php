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
use Vashakidze\Telegram\Exceptions\TelegramArgsException;

/**
 * Class SendDocument
 * @package Vashakidze\Telegram\Api\InputTypes
 *
 * @link https://core.telegram.org/bots/api#senddocument
 *
 * @property-read int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
 * @property-read InputFile|string $document File to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data
 * @property-read string|null $caption Document caption (may also be used when resending documents by file_id), 0-1024 characters after entities parsing
 * @property-read ParseMode|null $parseMode Mode for parsing entities in the message text.
 * @property-read MessageEntity[]|null $captionEntities A JSON-serialized list of special entities that appear in message text, which can be specified instead of parse_mode
 * @property-read bool|null $disableContentTypeDetection Disables automatic server-side content type detection for files uploaded using multipart/form-data
 * @property-read InputFile|string|null $thumb Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>
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
 * @method self setDisableContentTypeDetection(bool $disableContentTypeDetection = true)
 * @method self setDisableNotification(bool $disableNotification = true)
 * @method self setProtectContent(bool $protectContent = true)
 * @method self setReplyToMessageId(int $replyToMessageId)
 * @method self setAllowSendingWithoutReply(bool $allowSendingWithoutReply = true)
 * @method self setReplyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup)
 */
class SendDocument extends InputType
{
    protected int|string $chatId;
    protected InputFile|string $document;
    protected ?string $caption;
    protected ?ParseMode $parseMode;
    protected array|JsonSerializable|null $captionEntities;
    protected InputFile|string|null $thumb;
    protected ?bool $disableContentTypeDetection;
    protected ?bool $disableNotification;
    protected ?bool $protectContent;
    protected ?int $replyToMessageId;
    protected ?bool $allowSendingWithoutReply;
    protected InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup;

    public function setDocument(InputFile|string $document): self
    {
        if ($document instanceof InputFile) {
            $this->document = $document->setName('document');

            return $this;
        }

        $this->document = $document;
        return $this;
    }

    /**
     * @param InputFile|string $thumb
     * @return $this
     * @throws TelegramArgsException
     */
    public function setThumb(InputFile|string $thumb): self
    {
        if (is_string($thumb)) {
            $this->thumb = $thumb;

            return $this;
        }
        $thumb->setName('thumb');

        if (!in_array($thumb->extension, ['jpeg', 'jpg'])) {
            throw new TelegramArgsException("You set incorrect \"thumb\" file. File type must be JPEG");
        }

        if ($thumb->size > 204800) {
            throw new TelegramArgsException("You set incorrect \"thumb\" file. File is to big. Max size: 200 kB");
        }

        return $this;
    }
}
