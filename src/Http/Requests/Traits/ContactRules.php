<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


/**
 * Trait ContactRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#contact
 */
trait ContactRules
{
    use RulesHelper;

    protected function getContactRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'phone_number' => [
                $required,
                'int',
            ],
            $prefix . 'first_name' => [
                $required,
                'string',
            ],
            $prefix . 'last_name' => [
                'nullable',
                'string',
            ],
            $prefix . 'user_id' => [
                'nullable',
                'int',
            ],
            $prefix . 'vcard' => [
                'nullable',
                'string',
            ],
        ];
    }
}
