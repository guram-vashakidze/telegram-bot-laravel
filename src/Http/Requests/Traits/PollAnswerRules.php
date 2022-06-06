<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait PollAnswerRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#pollanswer
 */
trait PollAnswerRules
{
    use RulesHelper;
    use UserRules;

    protected function getPollAnswerRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'poll_id' => [
                    $required,
                    'string',
                ],
                $prefix . 'user' => [
                    $required,
                    'string',
                ],
                $prefix . 'option_ids' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'option_ids.*' => [
                    'nullable',
                    'int'
                ]
            ],
            $this->getUserRules($prefix . 'user')
        );
    }
}
