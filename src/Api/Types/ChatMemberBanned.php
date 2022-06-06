<?php


namespace Vashakidze\Telegram\Api\Types;


use Carbon\Carbon;
use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Api\Enums\ChatMemberStatus;

/**
 * Class ChatMemberBanned
 * @package Vashakidze\Telegram\Api\Types
 *
 * Represents a chat member that was banned in the chat and can't return to the chat or view chat messages
 *
 * @link https://core.telegram.org/bots/api#chatmemberbanned
 *
 * @property-read ChatMemberStatus $status The member's status in the chat, always “kicked”
 * @property-read User $user Information about the user
 * @property-read Carbon|null $untilDate Date when restrictions will be lifted for this user; unix time. If 0, then the user is banned forever
 */
class ChatMemberBanned extends Type
{
    protected ChatMemberStatus $status;
    protected User $user;
    protected ?Carbon $untilDate;

    public static function init(array $data): self
    {
        $banned = new self();

        $banned->status = ChatMemberStatus::fromValue($data['status']);
        $banned->user = User::init($data['user']);
        $banned->untilDate = !empty($data['until_date']) ? Carbon::createFromTimestamp($data['until_date']) : null;

        return $banned;
    }
}
