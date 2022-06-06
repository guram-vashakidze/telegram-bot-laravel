<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait VideoChatScheduledRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#videochatscheduled
 */
trait VideoChatScheduledRules
{
    use RulesHelper;

    protected function getVideoChatScheduledRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'start_date' => [
                $required,
                'int',
            ],
        ];
    }
}
