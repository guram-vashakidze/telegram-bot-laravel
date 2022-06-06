<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class ButtonPoll
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents type of a poll, which is allowed to be created and sent when the corresponding button is pressed
 *
 * @link https://core.telegram.org/bots/api#keyboardbuttonpolltype
 *
 * @property-read string $type
 *
 * @method self setType(string $type)
 */
class KeyboardButtonPoll extends Type
{
    protected string $type;

    public static function init(array $data): self
    {
        $buttonPoll = new self();

        $buttonPoll->type = $data['type'];

        return $buttonPoll;
    }
}
