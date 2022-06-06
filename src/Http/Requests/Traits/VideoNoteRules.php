<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait VideoNoteRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#videonote
 */
trait VideoNoteRules
{
    use RulesHelper;
    use PhotoSizeRules;

    protected function getVideoNoteRules(?string $prefix = null): array
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
                $prefix . 'length' => [
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
                $prefix . 'file_size' => [
                    'nullable',
                    'int',
                ],
            ],
            $this->getPhotoSizeRules($prefix . 'thumb')
        );
    }
}
