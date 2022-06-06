<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait UserRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#user
 */
trait UserRules
{
    use RulesHelper;

    protected function getUserRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'id' => [
                $required,
                'int',
            ],
            $prefix . 'is_bot' => [
                $required,
                'boolean',
            ],
            $prefix . 'first_name' => [
                $required,
                'string',
            ],
            $prefix . 'last_name' => [
                'nullable',
                'string',
            ],
            $prefix . 'username' => [
                'nullable',
                'string',
            ],
            $prefix . 'language_code' => [
                'nullable',
                'string',
            ],
            $prefix . 'can_join_groups' => [
                'nullable',
                'boolean',
            ],
            $prefix . 'can_read_all_group_messages' => [
                'nullable',
                'boolean',
            ],
            $prefix . 'supports_inline_queries' => [
                'nullable',
                'boolean',
            ],
        ];
    }
}
