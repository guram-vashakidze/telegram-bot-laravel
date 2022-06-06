<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class CallbackGame
 * @package Vashakidze\Telegram\Api\Types
 *
 * A placeholder, currently holds no information. Use BotFather to set up your game
 *
 * @link https://core.telegram.org/bots/api#callbackgame
 */
class CallbackGame extends Type
{
    public static function init(array $data): Type
    {
        return new self();
    }
}
