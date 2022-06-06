<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class Sticker
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a sticker.
 *
 * @link https://core.telegram.org/bots/api#sticker
 *
 * @property-read string $fileId Identifier for this file, which can be used to download or reuse the file
 * @property-read string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property-read int $width Sticker width
 * @property-read int $height Sticker height
 * @property-read bool $isAnimated True, if the sticker is animated
 * @property-read bool $isVideo True, if the sticker is a video sticker
 * @property-read PhotoSize|null $thumb Sticker thumbnail in the .WEBP or .JPG format
 * @property-read string|null $emoji Emoji associated with the sticker
 * @property-read string|null $setName Name of the sticker set to which the sticker belongs
 * @property-read MaskPosition|null $maskPosition For mask stickers, the position where the mask should be placed
 * @property-read int|null $fileSize File size in bytes
 */
class Sticker extends Type
{
    protected string $fileId;
    protected string $fileUniqueId;
    protected int $width;
    protected int $height;
    protected bool $isAnimated;
    protected bool $isVideo;
    protected ?PhotoSize $thumb;
    protected ?string $emoji;
    protected ?string $setName;
    protected ?MaskPosition $maskPosition;
    protected ?int $fileSize;

    public static function init(array $data): self
    {
        $sticker = new self();

        $sticker->fileId = $data['file_id'];
        $sticker->fileUniqueId = $data['file_unique_id'];
        $sticker->width = $data['width'];
        $sticker->height = $data['height'];
        $sticker->isAnimated = $data['is_animated'];
        $sticker->isVideo = $data['is_video'];
        $sticker->thumb = !empty($data['thumb']) ? PhotoSize::init($data['thumb']) : null;
        $sticker->emoji = $data['emoji'] ?? null;
        $sticker->setName = $data['set_name'] ?? null;
        $sticker->maskPosition = !empty($data['mask_position']) ? MaskPosition::init($data['mask_position']) : null;
        $sticker->fileSize = $data['file_size'] ?? null;

        return $sticker;
    }
}
