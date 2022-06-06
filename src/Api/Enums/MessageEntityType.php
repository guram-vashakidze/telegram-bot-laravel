<?php

namespace Vashakidze\Telegram\Api\Enums;


use BenSampo\Enum\Enum;

/**
 * Class MessageEntityType
 * @package Vashakidze\Telegram\Api\Enums
 *
 * @method static static mention()
 * @method static static hashtag()
 * @method static static cashtag()
 * @method static static bot_command()
 * @method static static url()
 * @method static static email()
 * @method static static phone_number()
 * @method static static bold()
 * @method static static italic()
 * @method static static underline()
 * @method static static strikethrough()
 * @method static static spoiler()
 * @method static static code()
 * @method static static pre()
 * @method static static text_link()
 * @method static static text_mention()
 *
 * @link https://core.telegram.org/bots/api#messageentity
 */
final class MessageEntityType extends Enum
{
    public const mention = 'mention';
    public const hashtag = 'hashtag';
    public const cashtag = 'cashtag';
    public const bot_command = 'bot_command';
    public const url = 'url';
    public const email = 'email';
    public const phone_number = 'phone_number';
    public const bold = 'bold';
    public const italic = 'italic';
    public const underline = 'underline';
    public const strikethrough = 'strikethrough';
    public const spoiler = 'spoiler';
    public const code = 'code';
    public const pre = 'pre';
    public const text_link = 'text_link';
    public const text_mention = 'text_mention';
}
