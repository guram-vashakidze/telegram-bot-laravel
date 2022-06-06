<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Api\Enums\ChatType;

/**
 * Class InlineQuery
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents an incoming inline query. When the user sends an empty query, your bot could return some default or trending results
 *
 * @link https://core.telegram.org/bots/api#inlinequery
 *
 * @property-read string $id Unique identifier for this query
 * @property-read User $from Sender
 * @property-read string $query Text of the query (up to 256 characters)
 * @property-read string offset Offset of the results to be returned, can be controlled by the bot
 * @property-read ChatType|null $chatType Type of the chat, from which the inline query was sent
 * @property-read Location|null $location Sender location, only for bots that request user location
 */
class InlineQuery extends Type
{
    protected string $id;
    protected User $from;
    protected string $query;
    protected string $offset;
    protected ?ChatType $chatType;
    protected ?Location $location;

    public static function init(array $data): self
    {
        $inlineQuery = new self();

        $inlineQuery->id = $data['id'];
        $inlineQuery->from = User::init($data['from']);
        $inlineQuery->query = $data['query'];
        $inlineQuery->offset = $data['offset'];
        $inlineQuery->chatType = !empty($data['chat_type']) ? ChatType::fromValue($data['chat_type']) : null;
        $inlineQuery->location = !empty($data['location']) ? Location::init($data['location']) : null;

        return $inlineQuery;
    }
}
