<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class PhotoSize
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents one size of a photo or a file / sticker thumbnail.
 *
 * @link https://core.telegram.org/bots/api#photosize
 *
 * @property-read string $fileId Identifier for this file, which can be used to download or reuse the file
 * @property-read string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file
 * @property-read int $width Photo width
 * @property-read int $height Photo height
 * @property-read int|null $fileSize File size in bytes
 */
class PhotoSize extends Type
{
    protected string $fileId;
    protected string $fileUniqueId;
    protected int $width;
    protected int $height;
    protected ?int $fileSize;

    public static function init(array $data): self
    {
        $photoSize = new self();

        $photoSize->fileId = $data['file_id'];
        $photoSize->fileUniqueId = $data['file_unique_id'];
        $photoSize->width = $data['width'];
        $photoSize->height = $data['height'];
        $photoSize->fileSize = $data['file_size'] ?? null;

        return $photoSize;
    }
}
