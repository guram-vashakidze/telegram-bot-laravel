<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait ChatPhotoRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#chatphoto
 */
trait ChatPhotoRules
{
    use RulesHelper;

    protected function getChatPhotoRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'small_file_id' => [
                $required,
                'string',
            ],
            $prefix . 'small_file_unique_id' => [
                $required,
                'string',
            ],
            $prefix . 'big_file_id' => [
                $required,
                'string',
            ],
            $prefix . 'big_file_unique_id' => [
                $required,
                'string',
            ],
        ];
    }
}
