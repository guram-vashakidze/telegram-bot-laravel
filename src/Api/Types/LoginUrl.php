<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class LoginUrl
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a parameter of the inline keyboard button used to automatically authorize a user. Serves as a
 * great replacement for the Telegram Login Widget when the user is coming from Telegram. All the user needs to do is
 * tap/click a button and confirm that they want to log in:
 *
 * @link https://core.telegram.org/bots/api#loginurl
 *
 * @property-read string $url An HTTP URL to be opened with user authorization data added to the query string when the button is pressed. If the user refuses to provide authorization data, the original URL without information about the user will be opened. The data added is the same as described in Receiving authorization data.
 * @property-read string|null $forwardText New text of the button in forwarded messages
 * @property-read string|null $botUsername Username of a bot, which will be used for user authorization. See Setting up a bot for more details. If not specified, the current bot's username will be assumed. The url's domain must be the same as the domain linked with the bot. See Linking your domain to the bot for more details
 * @property-read bool|null $requestWriteAccess Pass True to request the permission for your bot to send messages to the user
 *
 * @method self setUrl(string $url)
 * @method self setForwardText(string $forwardText)
 * @method self setBotUsername(string $botUsername)
 * @method self setRequestWriteAccess(bool $requestWriteAccess = true)
 */
class LoginUrl extends Type
{
    protected string $url;
    protected ?string $forwardText;
    protected ?string $botUsername;
    protected ?bool $requestWriteAccess;

    public static function init(array $data): self
    {
        $loginUrl = new self();

        $loginUrl->url = $data['url'];
        $loginUrl->forwardText = $data['forward_text'] ?? null;
        $loginUrl->botUsername = $data['bot_username'] ?? null;
        $loginUrl->requestWriteAccess = $data['request_write_access'] ?? null;

        return $loginUrl;
    }
}
