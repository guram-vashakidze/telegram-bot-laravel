<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait ChosenInlineResultRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#choseninlineresult
 */
trait ChosenInlineResultRules
{
    use RulesHelper;
    use LocationRules;
    use UserRules;

    protected function getChosenInlineResultRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'result_id' => [
                    $required,
                    'string',
                ],
                $prefix . 'from' => [
                    $required,
                    'array',
                ],
                $prefix . 'location' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'query' => [
                    $required,
                    'string'
                ],
                $prefix . 'inline_message_id' => [
                    'nullable',
                    'string'
                ],
            ],
            $this->getUserRules($prefix . 'from'),
            $this->getLocationRules($prefix . 'location'),
        );
    }
}
