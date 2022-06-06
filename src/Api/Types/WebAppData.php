<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class WebAppData
 * @package Vashakidze\Telegram\Api\Types
 *
 * Contains data sent from a Web App to the bot
 *
 * @link https://core.telegram.org/bots/api#webappdata
 *
 * @property-read string $data The data. Be aware that a bad client can send arbitrary data in this field
 * @property-read string $buttonText Text of the web_app keyboard button, from which the Web App was opened. Be aware that a bad client can send arbitrary data in this field
 */
class WebAppData extends Type
{
    protected string $data;
    protected string $buttonText;

    public static function init(array $data): self
    {
        $webAppData = new self();

        $webAppData->data = $data['data'];
        $webAppData->buttonText = $data['button_text'];

        return $webAppData;
    }
}
