<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class VideoChatParticipantsInvited
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a service message about new members invited to a video chat
 *
 * @link https://core.telegram.org/bots/api#videochatparticipantsinvited
 *
 * @property-read User[] $users New members that were invited to the video chat
 */
class VideoChatParticipantsInvited extends Type
{
    protected array $users;

    public static function init(array $data): Type
    {
        $participants = new self();

        $participants->users = [];

        foreach ($data['users'] as $user) {
            $participants->users[] = User::init($user);
        }

        return $participants;
    }
}
