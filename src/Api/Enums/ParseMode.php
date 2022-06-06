<?php


namespace Vashakidze\Telegram\Api\Enums;


use BenSampo\Enum\Enum;

/**
 * Class ParseMode
 * @package Vashakidze\Telegram\Api\Enums
 *
 * @link https://core.telegram.org/bots/api#formatting-options
 *
 * @method static static MarkdownV2()
 * @method static static HTML()
 * @method static static Markdown()
 */
class ParseMode extends Enum
{
    public const MarkdownV2 = 'MarkdownV2';
    public const HTML = 'HTML';
    public const Markdown = 'Markdown';
}
