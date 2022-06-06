<?php


namespace Vashakidze\Telegram\Api\Types;


use JsonSerializable;
use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Exceptions\TelegramArgsException;

/**
 * Class ReplyKeyboardRemove
 * @package Vashakidze\Telegram\Api\Types
 *
 * Upon receiving a message with this object, Telegram clients will remove the current custom keyboard and display the
 * default letter-keyboard. By default, custom keyboards are displayed until a new keyboard is sent by a bot. An exception
 * is made for one-time keyboards that are hidden immediately after the user presses a button
 *
 * @link https://core.telegram.org/bots/api#replykeyboardremove
 *
 * @property-read bool $removeKeyboard Requests clients to remove the custom keyboard (user will not be able to summon this keyboard; if you want to hide the keyboard from sight but keep it accessible, use one_time_keyboard in ReplyKeyboardMarkup)
 * @property-read bool|null $selective  Use this parameter if you want to remove the keyboard for specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
 *
 * @method self setRemoveKeyboard(bool $removeKeyboard = true)
 * @method self setSelective(bool $selective = true)
 */
class ReplyKeyboardRemove extends Type implements JsonSerializable
{
    protected bool $removeKeyboard = true;
    protected ?bool $selective;

    public static function init(array $data): self
    {
        $keyboard = new self();

        $keyboard->removeKeyboard = $data['remove_keyboard'];
        $keyboard->selective = $data['selective'] ?? null;

        return $keyboard;
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
