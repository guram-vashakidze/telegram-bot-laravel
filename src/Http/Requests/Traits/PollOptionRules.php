<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait PollOptionRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#polloption
 */
trait PollOptionRules
{
    use RulesHelper;

    protected function getPollOptionRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'text' => [
                $required,
                'string',
            ],
            $prefix . 'voter_count' => [
                $required,
                'int',
            ],
        ];
    }
}
