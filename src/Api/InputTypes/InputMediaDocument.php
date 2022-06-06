<?php


namespace Vashakidze\Telegram\Api\InputTypes;


use JsonSerializable;
use Vashakidze\Telegram\Api\Enums\InputMediaType;
use Vashakidze\Telegram\Api\Enums\ParseMode;
use Vashakidze\Telegram\Api\InputType;
use Vashakidze\Telegram\Api\Types\MessageEntity;
use Vashakidze\Telegram\Exceptions\TelegramArgsException;

/**
 * Class InputMediaDocument
 * @package Vashakidze\Telegram\Api\InputTypes
 *
 * Represents an audio file to be treated as music to be sent
 *
 * @link https://core.telegram.org/bots/api#inputmediaaudio
 *
 * @property-read InputMediaType $type
 * @property-read string $media
 * @property-read InputMediaType|string|null $thumb
 * @property-read string|null $caption
 * @property-read ParseMode|null $parseMode
 * @property-read MessageEntity[]|null $captionEntities
 * @property-read int|null $duration
 * @property-read string|null $performer
 * @property-read string|null $title
 *
 * @method self setCaption(string $caption)
 * @method self setParseMode(ParseMode $parseMode)
 * @method self setCaptionEntities(MessageEntity[] $captionEntities)
 * @method self setDuration(int $duration)
 * @method self setPerformer(string $performer)
 * @method self setTitle(string $title)
 */
class InputMediaDocument extends InputType
{
    protected InputMediaType $type;
    protected string $media;
    protected InputFile|string|null $thumb;
    protected ?string $caption;
    protected ?ParseMode $parseMode;
    protected array|JsonSerializable|null $captionEntities;
    protected ?int $duration;
    protected ?string $performer;
    protected ?string $title;

    protected InputType $file;

    public function setMedia(InputFile|string $file): self
    {
        if (is_string($file)) {
            $this->media = $file;

            return $this;
        }
        $this->media = 'attach://' . $file->name;
        $this->file = $file;

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
