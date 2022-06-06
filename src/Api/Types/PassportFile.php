<?php


namespace Vashakidze\Telegram\Api\Types;


use Carbon\Carbon;
use Vashakidze\Telegram\Api\Type;

/**
 * Class PassportFile
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a file uploaded to Telegram Passport. Currently all Telegram Passport files are in JPEG format when decrypted and don't exceed 10MB
 *
 * @link https://core.telegram.org/bots/api#passportfile
 *
 * @property-read string $fileId Identifier for this file, which can be used to download or reuse the file
 * @property-read string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file
 * @property-read int $fileSize File size in bytes
 * @property-read Carbon $fileDate Unix time when the file was uploaded
 */
class PassportFile extends Type
{
    protected string $fileId;
    protected string $fileUniqueId;
    protected int $fileSize;
    protected Carbon $fileDate;

    public static function init(array $data): self
    {
        $passportFile = new self();

        $passportFile->fileId = $data['file_id'];
        $passportFile->fileUniqueId = $data['file_unique_id'];
        $passportFile->fileSize = $data['file_size'];
        $passportFile->fileDate = Carbon::createFromTimestamp($data['file_date']);

        return $passportFile;
    }
}
