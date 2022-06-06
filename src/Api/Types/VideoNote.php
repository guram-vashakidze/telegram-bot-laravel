<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class VideoNote
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a video message (available in Telegram apps as of v.4.0).
 *
 * @link https://core.telegram.org/bots/api#videonote
 *
 * @property-read string $fileId Identifier for this file, which can be used to download or reuse the file
 * @property-read string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property-read int $length Video width and height (diameter of the video message) as defined by sender
 * @property-read int $duration Duration of the video in seconds as defined by sender
 * @property-read PhotoSize|null $thumb VideoNote thumbnail
 * @property-read int|null $fileSize File size in bytes
 */
class VideoNote extends Type
{
    protected string $fileId;
    protected string $fileUniqueId;
    protected int $length;
    protected int $duration;
    protected ?PhotoSize $thumb;
    protected ?int $fileSize;

    public static function init(array $data): self
    {
        $video = new self();

        $video->fileId = $data['file_id'];
        $video->fileUniqueId = $data['file_unique_id'];
        $video->length = $data['length'];
        $video->duration = $data['duration'];
        $video->thumb = !empty($data['thumb']) ? PhotoSize::init($data['thumb']) : null;
        $video->fileSize = $data['file_size'] ?? null;

        return $video;
    }
}
