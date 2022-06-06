<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use BenSampo\Enum\Rules\EnumValue;

use Vashakidze\Telegram\Api\Enums\PollType;

use function array_merge;

/**
 * Trait PollRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#poll
 */
trait PollRules
{
    use RulesHelper;
    use MessageEntityRules;
    use PollOptionRules;

    protected function getPollRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'id' => [
                    $required,
                    'string',
                ],
                $prefix . 'question' => [
                    $required,
                    'string',
                ],
                $prefix . 'options' => [
                    $required,
                    'array',
                ],
                $prefix . 'total_voter_count' => [
                    $required,
                    'int',
                ],
                $prefix . 'is_closed' => [
                    $required,
                    'bool',
                ],
                $prefix . 'is_anonymous' => [
                    $required,
                    'bool',
                ],
                $prefix . 'type' => [
                    $required,
                    'string',
                    new EnumValue(PollType::class)
                ],
                $prefix . 'allows_multiple_answers' => [
                    $required,
                    'bool',
                ],
                $prefix . 'correct_option_id' => [
                    'nullable',
                    'int',
                ],
                $prefix . 'explanation' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'explanation_entities' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'open_period' => [
                    'nullable',
                    'int',
                ],
                $prefix . 'close_date' => [
                    'nullable',
                    'int',
                ],
            ],
            $this->getMessageEntityRules($prefix . 'explanation_entities.*'),
            $this->getPollOptionRules($prefix . 'options.*')
        );
    }
}
