<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class CallbackQuery
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents an incoming callback query from a callback button in an inline keyboard. If the button that
 * originated the query was attached to a message sent by the bot, the field message will be present. If the button was
 * attached to a message sent via the bot (in inline mode), the field inline_message_id will be present. Exactly one of
 * the fields data or game_short_name will be present
 *
 * @link https://core.telegram.org/bots/api#callbackquery
 *
 * @property-read string $id Unique identifier for this query
 * @property-read User $from Sender
 * @property-read Message|null $message Message with the callback button that originated the query. Note that message content and message date will not be available if the message is too old
 * @property-read string|null $inlineMessageId Identifier of the message sent via the bot in inline mode, that originated the query
 * @property-read string $chatInstance Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent. Useful for high scores in games
 * @property-read string|null $data Data associated with the callback button. Be aware that a bad client can send arbitrary data in this field
 * @property-read string|null $gameShortName Short name of a Game to be returned, serves as the unique identifier for the game
 */
class CallbackQuery extends Type
{
    protected string $id;
    protected User $from;
    protected ?Message $message;
    protected ?string $inlineMessageId;
    protected string $chatInstance;
    protected ?string $data;
    protected ?string $gameShortName;

    public static function init(array $data): self
    {
        $callbackQuery = new self();

        $callbackQuery->id = $data['id'];
        $callbackQuery->from = User::init($data['from']);
        $callbackQuery->message = !empty($data['message']) ? Message::init($data['message']) : null;
        $callbackQuery->inlineMessageId = $data['inline_message_id'] ?? null;
        $callbackQuery->chatInstance = $data['chat_instance'];
        $callbackQuery->data = $data['data'] ?? null;
        $callbackQuery->gameShortName = $data['game_short_name'] ?? null;

        return $callbackQuery;
    }
}
