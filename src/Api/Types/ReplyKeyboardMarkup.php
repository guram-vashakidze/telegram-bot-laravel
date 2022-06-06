<?php


namespace Vashakidze\Telegram\Api\Types;


use JsonSerializable;
use Vashakidze\Telegram\Api\Type;

use Vashakidze\Telegram\Exceptions\TelegramArgsException;

use function count;

/**
 * Class InlineKeyboardMarkup
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents an inline keyboard that appears right next to the message it belongs to
 *
 * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
 *
 * @property-read KeyboardButton[][] $keyboard Array of button rows, each represented by an Array of KeyboardButton objects
 * @property-read bool|null $resizeKeyboard Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard
 * @property-read bool|null $oneTimeKeyboard Requests clients to hide the keyboard as soon as it's been used. The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat – the user can press a special button in the input field to see the custom keyboard again. Defaults to false
 * @property-read string|null $inputFieldPlaceholder The placeholder to be shown in the input field when the keyboard is active; 1-64 characters
 * @property-read bool|null $selective Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message
 *
 * @method self setKeyboard(InlineKeyboardButton[][] $keyboard)
 * @method self setResizeKeyboard(bool $resizeKeyboard = true)
 * @method self setOneTimeKeyboard(bool $oneTimeKeyboard = true)
 * @method self setSelective(bool $selective = true)
 */
class ReplyKeyboardMarkup extends Type implements JsonSerializable
{
    protected array $keyboard = [];
    protected ?bool $resizeKeyboard;
    protected ?bool $oneTimeKeyboard;
    protected ?string $inputFieldPlaceholder;
    protected ?bool $selective;

    public static function init(array $data): self
    {
        $keyboard = new self();

        for ($i = 0, $max = count($data); $i < $max; $i++) {
            foreach ($data[$i] as $row) {
                $row = KeyboardButton::init($row);

                $keyboard->keyboard[$i][] = $row;
            }
        }

        $keyboard->resizeKeyboard = $data['resize_keyboard'] ?? null;
        $keyboard->oneTimeKeyboard = $data['one_time_keyboard'] ?? null;
        $keyboard->inputFieldPlaceholder = $data['one_time_keyboard'] ?? null;
        $keyboard->selective = $data['selective'] ?? null;

        return $keyboard;
    }

    /**
     * @param string $inputFieldPlaceholder
     * @return $this
     * @throws TelegramArgsException
     */
    public function setInputFieldPlaceholder(string $inputFieldPlaceholder): self
    {
        $length = strlen($inputFieldPlaceholder);

        if ($length < 1 || $length > 64) {
            throw new TelegramArgsException('Field "inputFieldPlaceholder" must be 1-64 characters');
        }

        $this->inputFieldPlaceholder = $inputFieldPlaceholder;

        return $this;
    }

    public function setKeyboardButton(KeyboardButton $button, int $row, int $column): self
    {
        $this->keyboard[$row - 1][$column - 1] = $button;

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
