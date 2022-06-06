<?php

namespace Vashakidze\Telegram\Api\Enums;

use BenSampo\Enum\Enum;

/**
 * Class ChatType
 * @package Vashakidze\Telegram\Api\Enums
 *
 * @method static static private ()
 * @method static static group()
 * @method static static supergroup()
 * @method static static channel()
 *
 * @link https://core.telegram.org/bots/api#chat
 */
final class ChatType extends Enum
{
    public const private = 'private';
    public const group = 'group';
    public const supergroup = 'supergroup';
    public const channel = 'channel';
}
