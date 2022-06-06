<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class Dice
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents an animated emoji that displays a random value.
 *
 * @link https://core.telegram.org/bots/api#dice
 *
 * @property-read string $emoji Emoji on which the dice throw animation is based
 * @property-read int $value Value of the dice
 */
class Dice extends Type
{
    protected string $emoji;
    protected int $value;

    public static function init(array $data): self
    {
        $dice = new self();

        $dice->emoji = $data['emoji'];
        $dice->value = $data['value'];

        return $dice;
    }
}
