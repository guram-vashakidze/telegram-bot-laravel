<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

use Vashakidze\Telegram\Exceptions\TelegramArgsException;

use function array_key_exists;

/**
 * Class InlineKeyboardButton
 * @package Vashakidze\Telegram\Api\Types\
 *
 * This object represents one button of an inline keyboard. You must use exactly one of the optional fields.
 *
 * @link https://core.telegram.org/bots/api#inlinekeyboardbutton
 *
 * @property-read string $text Label text on the button
 * @property-read string|null $url HTTP or tg:// url to be opened when the button is pressed. Links tg://user?id=<user_id> can be used to mention a user by their ID without using a username, if this is allowed by their privacy settings
 * @property-read string|null $callbackData Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes
 * @property-read WebAppInfo|null $webApp Description of the Web App that will be launched when the user presses the button. The Web App will be able to send an arbitrary message on behalf of the user using the method answerWebAppQuery. Available only in private chats between a user and the bot
 * @property-read LoginUrl|null $loginUrl An HTTP URL used to automatically authorize the user. Can be used as a replacement for the Telegram Login Widget
 * @property-read string|null $switchInlineQuery If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot's username and the specified inline query in the input field. Can be empty, in which case just the bot's username will be inserted
 * @property-read string|null $switchInlineQueryCurrentChat If set, pressing the button will insert the bot's username and the specified inline query in the current chat's input field. Can be empty, in which case only the bot's username will be inserted
 * @property-read CallbackGame|null $callbackGame Description of the game that will be launched when the user presses the button
 * @property-read bool|null $pay Specify True, to send a Pay button
 *
 * @method self setText(string $text)
 * @method self setUrl(string $url)
 * @method self setWebApp(WebAppInfo $webApp)
 * @method self setLoginUrl(LoginUrl $loginUrl)
 * @method self setSwitchInlineQuery(string $switchInlineQuery)
 * @method self setSwitchInlineQueryCurrentChat(string $switchInlineQueryCurrentChat)
 * @method self setCallbackGame(CallbackGame $callbackGame)
 * @method self setPay(bool $pay = true)
 */
class InlineKeyboardButton extends Type
{
    protected string $text;
    protected ?string $url;
    protected ?string $callbackData;
    protected ?WebAppInfo $webApp;
    protected ?LoginUrl $loginUrl;
    protected ?string $switchInlineQuery;
    protected ?string $switchInlineQueryCurrentChat;
    protected ?CallbackGame $callbackGame;
    protected ?bool $pay;

    public static function init(array $data): self
    {
        $button = new self();

        $button->text = $data['text'];
        $button->url = $data['url'] ?? null;
        $button->callbackData = $data['callback_data'] ?? null;
        $button->webApp = !empty($data['web_app']) ? WebAppInfo::init($data['web_app']) : null;
        $button->loginUrl = !empty($data['login_url']) ? LoginUrl::init($data['login_url']) : null;
        $button->switchInlineQuery = $data['switch_inline_query'] ?? null;
        $button->switchInlineQueryCurrentChat = $data['switch_inline_query_current_chat'] ?? null;
        $button->callbackGame = array_key_exists('callback_game', $data) ? CallbackGame::init([]) : null;
        $button->pay = $data['pay'] ?? null;

        return $button;
    }

    /**
     * @param string $callbackData
     * @return $this
     * @throws TelegramArgsException
     */
    public function setCallbackData(string $callbackData): self
    {
        $length = strlen($callbackData);

        if ($length < 1 || $length > 64) {
            throw new TelegramArgsException('Field "callbackData" must be 1-64 characters');
        }

        $this->callbackData = $callbackData;

        return $this;
    }
}
