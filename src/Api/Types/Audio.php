<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class Audio
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents an audio file to be treated as music by the Telegram clients.
 *
 * @link https://core.telegram.org/bots/api#audio
 *
 * @property-read string $fileId Identifier for this file, which can be used to download or reuse the file
 * @property-read string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property-read int $duration Duration of the video in seconds as defined by sender
 * @property-read string|null $performer Performer of the audio as defined by sender or by audio tags
 * @property-read string|null $title Title of the audio as defined by sender or by audio tags
 * @property-read string|null $fileName Original filename as defined by sender
 * @property-read string|null $mimeType MIME type of the file as defined by sender
 * @property-read int|null $fileSize File size in bytes
 * @property-read PhotoSize|null $thumb Thumbnail of the album cover to which the music file belongs
 */
class Audio extends Type
{
    protected string $fileId;
    protected string $fileUniqueId;
    protected int $duration;
    protected ?string $performer;
    protected ?string $title;
    protected ?PhotoSize $thumb;
    protected ?string $fileName;
    protected ?string $mimeType;
    protected ?int $fileSize;

    public static function init(array $data): self
    {
        $audio = new self();

        $audio->fileId = $data['file_id'];
        $audio->fileUniqueId = $data['file_unique_id'];
        $audio->duration = $data['duration'];
        $audio->performer = $data['performer'] ?? null;
        $audio->title = $data['title'] ?? null;
        $audio->fileName = $data['file_name'] ?? null;
        $audio->mimeType = $data['mime_type'] ?? null;
        $audio->fileSize = $data['file_size'] ?? null;
        $audio->thumb = !empty($data['thumb']) ? PhotoSize::init($data['thumb']) : null;

        return $audio;
    }
}
