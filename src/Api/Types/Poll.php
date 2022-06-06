<?php


namespace Vashakidze\Telegram\Api\Types;


use Carbon\Carbon;
use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Api\Enums\PollType;

/**
 * Class Poll
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object contains information about a poll
 *
 * @link https://core.telegram.org/bots/api#poll
 *
 * @property-read string $id Unique poll identifier
 * @property-read string $question Poll question, 1-300 characters
 * @property-read PollOption[] $options List of poll options
 * @property-read int $totalVoterCount Total number of users that voted in the poll
 * @property-read bool $isClosed True, if the poll is closed
 * @property-read bool $isAnonymous True, if the poll is anonymous
 * @property-read PollType $type Poll type, currently can be “regular” or “quiz”
 * @property-read bool $allowsMultipleAnswers True, if the poll allows multiple answers
 * @property-read int|null $correctOptionId 0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
 * @property-read string|null $explanation Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters
 * @property-read MessageEntity[]|null $explanationEntities Special entities like usernames, URLs, bot commands, etc. that appear in the explanation
 * @property-read int|null $openPeriod Amount of time in seconds the poll will be active after creation
 * @property-read Carbon|null $closeDate Point in time (Unix timestamp) when the poll will be automatically closed
 */
class Poll extends Type
{
    protected string $id;
    protected string $question;
    protected array $options;
    protected int $totalVoterCount;
    protected bool $isClosed;
    protected bool $isAnonymous;
    protected PollType $type;
    protected bool $allowsMultipleAnswers;
    protected ?int $correctOptionId;
    protected ?string $explanation;
    protected ?array $explanationEntities;
    protected ?int $openPeriod;
    protected ?Carbon $closeDate;

    public static function init(array $data): self
    {
        $poll = new self();

        $poll->id = $data['id'];
        $poll->question = $data['question'];

        $poll->setPollOptions($data);

        $poll->totalVoterCount = $data['total_voter_count'];
        $poll->isClosed = $data['is_closed'];
        $poll->isAnonymous = $data['is_anonymous'];
        $poll->type = PollType::fromValue($data['type']);
        $poll->allowsMultipleAnswers = $data['allows_multiple_answers'];
        $poll->correctOptionId = $data['correct_option_id'] ?? null;
        $poll->explanation = $data['explanation'] ?? null;

        $poll->setTextEntities($data);

        $poll->openPeriod = $data['open_period'] ?? null;
        $poll->closeDate = !empty($data['close_date']) ? Carbon::createFromTimestamp($data['close_date']) : null;

        return $poll;
    }

    private function setPollOptions(array $data): void
    {
        $this->options = [];

        foreach ($data['options'] as $option) {
            $this->options[] = PollOption::init($option);
        }
    }

    private function setTextEntities(array $data): void
    {
        $this->explanationEntities = null;

        if (empty($data['explanation_entities'])) {
            return;
        }

        $this->explanationEntities = [];

        foreach ($data['explanation_entities'] as $entity) {
            $this->explanationEntities[] = MessageEntity::init($entity);
        }
    }
}
