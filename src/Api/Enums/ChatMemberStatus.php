<?php

namespace Vashakidze\Telegram\Api\Enums;

use BenSampo\Enum\Enum;

/**
 * Class ChatMemberStatus
 * @package Vashakidze\Telegram\Api\Enums
 *
 * @method static static creator()
 * @method static static administrator()
 * @method static static member()
 * @method static static restricted()
 * @method static static left()
 * @method static static kicked()
 *
 * @link https://core.telegram.org/bots/api#chatmember
 */
final class ChatMemberStatus extends Enum
{
    public const creator = 'creator';
    public const administrator = 'administrator';
    public const member = 'member';
    public const restricted = 'restricted';
    public const left = 'left';
    public const kicked = 'kicked';
}
