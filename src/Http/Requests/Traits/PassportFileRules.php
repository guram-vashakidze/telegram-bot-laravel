<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait PassportFileRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#passportfile
 */
trait PassportFileRules
{
    use RulesHelper;

    protected function getPassportFileRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'file_id' => [
                $required,
                'string',
            ],
            $prefix . 'file_unique_id' => [
                $required,
                'string',
            ],
            $prefix . 'file_size' => [
                $prefix,
                'int',
            ],
            $prefix . 'file_date' => [
                $prefix,
                'int',
            ],
        ];
    }
}
