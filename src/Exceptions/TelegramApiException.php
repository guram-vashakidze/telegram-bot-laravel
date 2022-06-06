<?php


namespace Vashakidze\Telegram\Exceptions;


use Exception;
use Throwable;

class TelegramApiException extends Exception implements Throwable
{
    private ?int $responseCode;

    public function __construct(array $response)
    {
        $this->responseCode = $response['response_code'];

        parent::__construct($response['message']);
    }

    public function getResponseCode(): ?int
    {
        return $this->responseCode;
    }

    public function getDescription(): string
    {
        return ($this->responseCode ? "Response status code: " . $this->responseCode . ". " : "") .
            $this->getMessage();
    }
}
