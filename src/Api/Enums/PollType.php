<?php

namespace Vashakidze\Telegram\Api\Enums;

use BenSampo\Enum\Enum;

/**
 * Class TelegramPollTypes
 * @package Vashakidze\Telegram\Api\Enums
 *
 * @method static static regular()
 * @method static static quiz()
 *
 * @link https://core.telegram.org/bots/api#poll
 */
final class PollType extends Enum
{
    public const regular = 'regular';
    public const quiz = 'quiz';
}
