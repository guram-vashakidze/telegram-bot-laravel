<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class ChosenInlineResult
 * @package Vashakidze\Telegram\Api\Types
 *
 * Represents a result of an inline query that was chosen by the user and sent to their chat partner
 *
 * @link https://core.telegram.org/bots/api#choseninlineresult
 *
 * @property-read string $resultId
 * @property-read User $from
 * @property-read Location|null $location
 * @property-read string|null $inlineMessageId
 * @property-read string $query
 */
class ChosenInlineResult extends Type
{
    protected string $resultId;
    protected User $from;
    protected ?Location $location;
    protected ?string $inlineMessageId;
    protected string $query;

    public static function init(array $data): self
    {
        $result = new self();

        $result->resultId = $data['result_id'];
        $result->from = User::init($data['from']);
        $result->location = !empty($data['location']) ? Location::init($data['location']) : null;
        $result->inlineMessageId = $data['inline_message_id'] ?? null;
        $result->query = $data['query'];

        return $result;
    }
}
