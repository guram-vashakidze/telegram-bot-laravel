<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait VideoChatEndedRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#videochatended
 */
trait VideoChatEndedRules
{
    use RulesHelper;

    protected function getVideoChatEndedRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'duration' => [
                $required,
                'int',
            ],
        ];
    }
}
