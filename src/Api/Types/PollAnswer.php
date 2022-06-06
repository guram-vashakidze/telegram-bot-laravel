<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class PollAnswer
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents an answer of a user in a non-anonymous poll
 *
 * @link https://core.telegram.org/bots/api#pollanswer
 *
 * @property-read string $pollId Unique poll identifier
 * @property-read User $user The user, who changed the answer to the poll
 * @property-read array $optionIds 0-based identifiers of answer options, chosen by the user. May be empty if the user retracted their vote
 */
class PollAnswer extends Type
{
    protected string $pollId;
    protected User $user;
    protected array $optionIds;

    public static function init(array $data): self
    {
        $answer = new self();

        $answer->pollId = $data['poll_id'];
        $answer->user = User::init($data['user']);
        $answer->optionIds = $data['option_ids'] ?? [];

        return $answer;
    }
}
