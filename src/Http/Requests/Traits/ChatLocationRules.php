<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait ChatLocationRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#chatlocation
 */
trait ChatLocationRules
{
    use RulesHelper;
    use LocationRules;

    protected function getChatLocationRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'address' => [
                    $required,
                    'string',
                ],
                $prefix . 'location' => [
                    $required,
                    'array',
                ]
            ],
            $this->getLocationRules($prefix . 'location')
        );
    }
}
