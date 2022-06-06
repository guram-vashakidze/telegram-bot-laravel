<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class PollOption
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object contains information about one answer option in a poll.
 *
 * @link https://core.telegram.org/bots/api#polloption
 *
 * @property-read string $text Option text, 1-100 characters
 * @property-read int $voterCount Number of users that voted for this option
 */
class PollOption extends Type
{
    protected string $text;
    protected int $voterCount;

    public static function init(array $data): self
    {
        $pollOption = new self();

        $pollOption->text = $data['text'];
        $pollOption->voterCount = $data['voter_count'];

        return $pollOption;
    }
}
