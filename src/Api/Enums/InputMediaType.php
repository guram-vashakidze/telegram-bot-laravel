<?php


namespace Vashakidze\Telegram\Api\Enums;


use BenSampo\Enum\Enum;

/**
 * Class InputMediaType
 * @package Vashakidze\Telegram\Api\Enums
 *
 * @method static static audio()
 * @method static static document()
 * @method static static photo()
 * @method static static video()
 */
class InputMediaType extends Enum
{
    public const audio = 'audio';
    public const document = 'document';
    public const photo = 'photo';
    public const video = 'video';
}
