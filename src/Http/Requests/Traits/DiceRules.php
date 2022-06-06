<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait DiceRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#dice
 */
trait DiceRules
{
    use RulesHelper;

    protected function getDiceRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'emoji' => [
                $required,
                'string',
            ],
            $prefix . 'value' => [
                $required,
                'int',
            ],
        ];
    }
}
