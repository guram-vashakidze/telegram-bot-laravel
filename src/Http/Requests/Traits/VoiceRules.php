<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait VoiceRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#voice
 */
trait VoiceRules
{
    use RulesHelper;
    use PhotoSizeRules;

    protected function getVoiceRules(?string $prefix = null): array
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
            $prefix . 'duration' => [
                $required,
                'int',
            ],
            $prefix . 'file_size' => [
                'nullable',
                'int',
            ],
            $prefix . 'mime_type' => [
                'nullable',
                'int',
            ],
        ];
    }
}
