<?php


namespace Vashakidze\Telegram\Api\InputTypes;


use Vashakidze\Telegram\Api\InputType;
use Vashakidze\Telegram\Exceptions\TelegramArgsException;

/**
 * Class InputFile
 * @package Vashakidze\Telegram\Api\InputType
 *
 * This object represents the contents of a file to be uploaded. Must be posted using multipart/form-data in the usual way that files are uploaded via the browser
 *
 * @link https://core.telegram.org/bots/api#inputfile
 *
 * @property-read string $name
 * @property-read string $contents
 * @property-read string $filename
 * @property-read string $extension
 * @property-read int $size
 */
class InputFile extends InputType
{
    protected string $name;
    protected string $contents;
    protected string $filename;
    protected string $extension;
    protected int $size;

    /**
     * @param string $filePath
     * @return $this
     * @throws TelegramArgsException
     */
    public function setFile(string $filePath): self
    {
        if (!file_exists($filePath)) {
            throw new TelegramArgsException("File not found. Path: " . $filePath);
        }

        $this->name = !isset($this->name) ? pathinfo($filePath, PATHINFO_BASENAME) : $this->name;
        $this->contents = file_get_contents($filePath);
        $this->filename = pathinfo($filePath, PATHINFO_FILENAME);
        $this->extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $this->size = filesize($filePath);

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
