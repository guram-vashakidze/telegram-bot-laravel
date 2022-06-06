<?php


namespace Vashakidze\Telegram\Api\InputTypes;


use Vashakidze\Telegram\Api\InputType;
use Vashakidze\Telegram\Api\Types\ForceReply;
use Vashakidze\Telegram\Api\Types\InlineKeyboardMarkup;
use Vashakidze\Telegram\Api\Types\ReplyKeyboardMarkup;
use Vashakidze\Telegram\Api\Types\ReplyKeyboardRemove;
use Vashakidze\Telegram\Exceptions\TelegramArgsException;

/**
 * Class SendVideoNote
 * @package Vashakidze\Telegram\Api\InputTypes
 *
 * @link https://core.telegram.org/bots/api#sendvideoNote
 *
 * @property-read int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
 * @property-read InputFile|string $videoNote VideoNote file to send. Pass a file_id as String to send an videoNote file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an videoNote file from the Internet, or upload a new one using multipart/form-data
 * @property-read int|null $duration Duration of the videoNote in seconds
 * @property-read int|null $length VideoNote length
 * @property-read InputFile|string|null $thumb Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's length and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>
 * @property-read bool|null $disableNotification Sends the message silently. Users will receive a notification with no sound
 * @property-read bool|null $protectContent Protects the contents of the sent message from forwarding and saving
 * @property-read int|null $replyToMessageId If the message is a reply, ID of the original message
 * @property-read bool|null $allowSendingWithoutReply Pass True, if the message should be sent even if the specified replied-to message is not found
 * @property-read InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user
 *
 * @method self setChatId(int|string $chatId)
 * @method self setDuration(int $duration)
 * @method self setLength(int $length)
 * @method self setDisableNotification(bool $disableNotification = true)
 * @method self setProtectContent(bool $protectContent = true)
 * @method self setReplyToMessageId(int $replyToMessageId)
 * @method self setAllowSendingWithoutReply(bool $allowSendingWithoutReply = true)
 * @method self setReplyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup)
 */
class SendVideoNote extends InputType
{
    protected int|string $chatId;
    protected InputFile|string $videoNote;
    protected ?int $duration;
    protected ?int $length;
    protected InputFile|string|null $thumb;
    protected ?bool $disableNotification;
    protected ?bool $protectContent;
    protected ?int $replyToMessageId;
    protected ?bool $allowSendingWithoutReply;
    protected InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup;

    public function setVideoNote(InputFile|string $videoNote): self
    {
        if ($videoNote instanceof InputFile) {
            $this->videoNote = $videoNote->setName('video_note');

            return $this;
        }

        $this->videoNote = $videoNote;
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
