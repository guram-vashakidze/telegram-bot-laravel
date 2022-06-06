<?php


namespace Vashakidze\Telegram\Api;



/**
 * Class TelegramType
 * @package Vashakidze\Telegram\Api
 */
abstract class Type extends TelegramObject
{
    abstract public static function init(array $data): self;
}
