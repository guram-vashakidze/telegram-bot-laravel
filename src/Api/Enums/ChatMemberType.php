<?php

namespace Vashakidze\Telegram\Api\Enums;

use BenSampo\Enum\Enum;
use Illuminate\Support\Str;

/**
 * Class ChatMemberType
 * @package Vashakidze\Telegram\Api\Enums
 *
 * List member types for ChatMemberStatus
 *
 * @method static static owner()
 * @method static static administrator()
 * @method static static member()
 * @method static static restricted()
 * @method static static left()
 * @method static static banned()
 *
 * @link https://core.telegram.org/bots/api#chatmember
 */
final class ChatMemberType extends Enum
{
    public const owner = 'owner';
    public const administrator = 'administrator';
    public const member = 'member';
    public const restricted = 'restricted';
    public const left = 'left';
    public const banned = 'banned';

    public static function fromStatus(string $status): self
    {
        return match ($status) {
            ChatMemberStatus::creator => self::owner(),
            ChatMemberStatus::kicked => self::banned(),
            default => self::fromValue($status)
        };
    }

    public function toSetMethodName(): string
    {
        return 'set' . Str::studly($this->value);
    }
}
