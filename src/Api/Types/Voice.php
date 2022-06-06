<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class Voice
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a voice note.
 *
 * @link https://core.telegram.org/bots/api#voice
 *
 * @property-read string $fileId Identifier for this file, which can be used to download or reuse the file
 * @property-read string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property-read int $duration Duration of the video in seconds as defined by sender
 * @property-read string|null $mimeType MIME type of the file as defined by sender
 * @property-read int|null $fileSize File size in bytes
 */
class Voice extends Type
{
    protected string $fileId;
    protected string $fileUniqueId;
    protected int $duration;
    protected ?PhotoSize $thumb;
    protected ?string $mimeType;
    protected ?int $fileSize;

    public static function init(array $data): self
    {
        $voice = new self();

        $voice->fileId = $data['file_id'];
        $voice->fileUniqueId = $data['file_unique_id'];
        $voice->duration = $data['duration'];
        $voice->mimeType = $data['mime_type'] ?? null;
        $voice->fileSize = $data['file_size'] ?? null;

        return $voice;
    }
}
