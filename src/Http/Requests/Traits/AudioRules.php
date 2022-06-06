<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait AudioRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#audio
 */
trait AudioRules
{
    use RulesHelper;
    use PhotoSizeRules;

    protected function getAudioRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
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
                $prefix . 'duration' => [
                    $required,
                    'int',
                ],
                $prefix . 'performer' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'title' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'thumb' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'file_name' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'mime_type' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'file_size' => [
                    'nullable',
                    'int',
                ],
            ],
            $this->getPhotoSizeRules($prefix . 'thumb')
        );
    }
}
