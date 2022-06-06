<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait PhotoSizeRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#photosize
 */
trait PhotoSizeRules
{
    use RulesHelper;

    protected function getPhotoSizeRules(?string $prefix = null): array
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
            $prefix . 'width' => [
                $required,
                'int',
            ],
            $prefix . 'height' => [
                $required,
                'int',
            ],
            $prefix . 'file_size' => [
                'nullable',
                'int',
            ],
        ];
    }
}
