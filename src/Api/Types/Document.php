<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class Document
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a general file (as opposed to photos, voice messages and audio files).
 *
 * @link https://core.telegram.org/bots/api#document
 *
 * @property-read string $fileId Identifier for this file, which can be used to download or reuse the file
 * @property-read string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property-read PhotoSize|null $thumb Document thumbnail as defined by sender
 * @property-read string|null $fileName Original filename as defined by sender
 * @property-read string|null $mimeType MIME type of the file as defined by sender
 * @property-read int|null $fileSize File size in bytes
 */
class Document extends Type
{
    protected string $fileId;
    protected string $fileUniqueId;
    protected ?PhotoSize $thumb;
    protected ?string $fileName;
    protected ?string $mimeType;
    protected ?int $fileSize;

    public static function init(array $data): self
    {
        $document = new self();

        $document->fileId = $data['file_id'];
        $document->fileUniqueId = $data['file_unique_id'];
        $document->thumb = !empty($data['thumb']) ? PhotoSize::init($data['thumb']) : null;
        $document->fileName = $data['file_name'] ?? null;
        $document->mimeType = $data['mime_type'] ?? null;
        $document->fileSize = $data['file_size'] ?? null;

        return $document;
    }
}
