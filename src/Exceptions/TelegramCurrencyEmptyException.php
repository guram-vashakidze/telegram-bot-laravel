<?php


namespace Vashakidze\Telegram\Exceptions;


use Exception;
use Throwable;

class TelegramCurrencyEmptyException extends Exception implements Throwable
{
    public function __construct()
    {
        parent::__construct("Currency not found");
    }
}
