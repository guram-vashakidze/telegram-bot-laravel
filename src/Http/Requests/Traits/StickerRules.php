<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait StickerRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#sticker
 */
trait StickerRules
{
    use RulesHelper;
    use PhotoSizeRules;
    use MaskPositionRules;

    protected function getStickerRules(?string $prefix = null): array
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
                $prefix . 'is_animated' => [
                    $required,
                    'bool',
                ],
                $prefix . 'is_video' => [
                    $required,
                    'bool',
                ],
                $prefix . 'thumb' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'emoji' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'set_name' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'mask_position' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'file_size' => [
                    'nullable',
                    'int',
                ],
            ],
            $this->getPhotoSizeRules($prefix . 'thumb'),
            $this->getMaskPositionRules($prefix . 'mask_position')
        );
    }
}
