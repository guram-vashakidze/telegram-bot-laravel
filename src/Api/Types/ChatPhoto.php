<?php

namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class ChatPhoto
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a chat photo
 *
 * @link https://core.telegram.org/bots/api#chatphoto
 *
 * @property-read string $smallFileId - File identifier of small (160x160) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed
 * @property-read string $smallFileUniqueId - Unique file identifier of small (160x160) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file
 * @property-read string $bigFileId - File identifier of big (640x640) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed
 * @property-read string $bigFileUniqueId - Unique file identifier of big (640x640) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file
 */
class ChatPhoto extends Type
{
    protected string $smallFileId;
    protected string $smallFileUniqueId;
    protected string $bigFileId;
    protected string $bigFileUniqueId;

    public static function init(array $data): self
    {
        $chatPhoto = new self();

        $chatPhoto->smallFileId = $data['small_file_id'];
        $chatPhoto->smallFileUniqueId = $data['small_file_unique_id'];
        $chatPhoto->bigFileId = $data['big_file_id'];
        $chatPhoto->bigFileUniqueId = $data['big_file_unique_id'];

        return $chatPhoto;
    }
}
