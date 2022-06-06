<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class WebAppInfo
 * @package Vashakidze\Telegram\Api\Types
 *
 * Contains information about a Web App
 *
 * @link https://core.telegram.org/bots/api#webappinfo
 *
 * @property-read string $url An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps
 *
 * @method self setUrl(string $url)
 */
class WebAppInfo extends Type
{
    protected string $url;

    public static function init(array $data): self
    {
        $webAppInfo = new self();

        $webAppInfo->url = $data['url'];

        return $webAppInfo;
    }
}
