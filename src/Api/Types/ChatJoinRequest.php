<?php


namespace Vashakidze\Telegram\Api\Types;


use Carbon\Carbon;
use Vashakidze\Telegram\Api\Type;

/**
 * Class ChatJoinRequest
 * @package Vashakidze\Telegram\Api\Types
 *
 * Represents a join request sent to a chat
 *
 * @link https://core.telegram.org/bots/api#chatjoinrequest
 *
 * @property-read Chat $chat Chat to which the request was sent
 * @property-read User $from User that sent the join request
 * @property-read Carbon $date Date the request was sent in Unix time
 * @property-read string|null $bio Bio of the user
 * @property-read ChatInviteLink|null $inviteLink Chat invite link that was used by the user to send the join request
 */
class ChatJoinRequest extends Type
{
    protected Chat $chat;
    protected User $from;
    protected Carbon $date;
    protected ?string $bio;
    protected ?ChatInviteLink $inviteLink;

    public static function init(array $data): self
    {
        $chatJoinRequest = new self();

        $chatJoinRequest->chat = Chat::init($data['chat']);
        $chatJoinRequest->from = User::init($data['from']);
        $chatJoinRequest->date = Carbon::createFromTimestamp($data['date']);
        $chatJoinRequest->bio = $data['bio'] ?? null;
        $chatJoinRequest->inviteLink = !empty($data['invite_link']) ? ChatInviteLink::init($data['invite_link']) : null;

        return $chatJoinRequest;
    }
}
