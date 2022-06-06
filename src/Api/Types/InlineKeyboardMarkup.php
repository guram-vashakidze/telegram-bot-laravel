<?php


namespace Vashakidze\Telegram\Api\Types;


use JsonSerializable;
use Vashakidze\Telegram\Api\Type;

use Vashakidze\Telegram\Exceptions\TelegramArgsException;

use function count;

/**
 * Class InlineKeyboardMarkup
 *
 * @param array<array<InlineKeyboardButton>> $inlineKeyboard
 * @method self setInlineKeyboard(array $inlineKeyboard)
 *
 * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
 *
 * @property-read InlineKeyboardButton[][] $inlineKeyboard Array of button rows, each represented by an Array of InlineKeyboardButton objects
 *
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents an inline keyboard that appears right next to the message it belongs to
 *
 */
class InlineKeyboardMarkup extends Type implements JsonSerializable
{
    protected array $inlineKeyboard = [];

    public static function init(array $data): self
    {
        $keyboard = new self();

        for ($i = 0, $max = count($data['inline_keyboard']); $i < $max; $i++) {
            foreach ($data['inline_keyboard'][$i] as $row) {
                $row = InlineKeyboardButton::init($row);

                $keyboard->inlineKeyboard[$i][] = $row;
            }
        }

        return $keyboard;
    }

    public function setInlineKeyboardButton(InlineKeyboardButton $button, int $row, int $column): self
    {
        $this->inlineKeyboard[$row - 1][$column - 1] = $button;

        return $this;
    }

    /**
     * @return array
     * @throws TelegramArgsException
     */
    public function jsonSerialize(): array
    {
        return $this->toRequest();
    }
}
