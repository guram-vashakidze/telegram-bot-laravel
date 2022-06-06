<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class Animation
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents an animation file (GIF or H.264/MPEG-4 AVC video without sound).
 *
 * @link https://core.telegram.org/bots/api#animation
 *
 * @property-read string $fileId Identifier for this file, which can be used to download or reuse the file
 * @property-read string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property-read int $width Video width as defined by sender
 * @property-read int $height Video height as defined by sender
 * @property-read int $duration Duration of the video in seconds as defined by sender
 * @property-read PhotoSize|null $thumb Animation thumbnail as defined by sender
 * @property-read string|null $fileName Original animation filename as defined by sender
 * @property-read string|null $mimeType MIME type of the file as defined by sender
 * @property-read int|null $fileSize File size in bytes
 */
class Animation extends Type
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
        $animation = new self();

        $animation->fileId = $data['file_id'];
        $animation->fileUniqueId = $data['file_unique_id'];
        $animation->width = $data['width'];
        $animation->height = $data['height'];
        $animation->duration = $data['duration'];
        $animation->thumb = !empty($data['thumb']) ? PhotoSize::init($data['thumb']) : null;
        $animation->fileName = $data['file_name'] ?? null;
        $animation->mimeType = $data['mime_type'] ?? null;
        $animation->fileSize = $data['file_size'] ?? null;

        return $animation;
    }
}
