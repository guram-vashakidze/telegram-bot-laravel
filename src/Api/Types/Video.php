<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class Video
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a video file.
 *
 * @link https://core.telegram.org/bots/api#video
 *
 * @property-read string $fileId Identifier for this file, which can be used to download or reuse the file
 * @property-read string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property-read int $width Video width as defined by sender
 * @property-read int $height Video height as defined by sender
 * @property-read int $duration Duration of the video in seconds as defined by sender
 * @property-read PhotoSize|null $thumb Video thumbnail
 * @property-read string|null $fileName Original video filename as defined by sender
 * @property-read string|null $mimeType MIME type of the file as defined by sender
 * @property-read int|null $fileSize File size in bytes
 */
class Video extends Type
{
    protected string $fileId;
    protected string $fileUniqueId;
    protected int $width;
    protected int $height;
    protected int $duration;
    protected ?PhotoSize $thumb;
    protected ?string $fileName;
    protected ?string $mimeType;
    protected ?int $fileSize;

    public static function init(array $data): self
    {
        $video = new self();

        $video->fileId = $data['file_id'];
        $video->fileUniqueId = $data['file_unique_id'];
        $video->width = $data['width'];
        $video->height = $data['height'];
        $video->duration = $data['duration'];
        $video->thumb = !empty($data['thumb']) ? PhotoSize::init($data['thumb']) : null;
        $video->fileName = $data['file_name'] ?? null;
        $video->mimeType = $data['mime_type'] ?? null;
        $video->fileSize = $data['file_size'] ?? null;

        return $video;
    }
}
