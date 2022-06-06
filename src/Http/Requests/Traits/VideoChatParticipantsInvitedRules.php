<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

use function array_merge;

/**
 * Trait VideoChatParticipantsInvitedRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#videochatparticipantsinvited
 */
trait VideoChatParticipantsInvitedRules
{
    use RulesHelper;
    use UserRules;

    protected function getVideoChatParticipantsInvitedRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'users' => [
                    $required,
                    'array',
                ],
            ],
            $this->getUserRules($prefix . 'users.*')
        );
    }
}
