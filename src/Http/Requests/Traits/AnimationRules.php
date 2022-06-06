<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait AnimationRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#animation
 */
trait AnimationRules
{
    use RulesHelper;
    use PhotoSizeRules;

    protected function getAnimationRules(?string $prefix = null): array
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
