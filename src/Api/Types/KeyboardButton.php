<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class KeyboardButton
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents one button of the reply keyboard. For simple text buttons String can be used instead of this
 * object to specify text of the button. Optional fields web_app, request_contact, request_location, and request_poll
 * are mutually exclusive.
 *
 * @link https://core.telegram.org/bots/api#keyboardbutton
 *
 * @property-read string $text Text of the button. If none of the optional fields are used, it will be sent as a message when the button is pressed
 * @property-read bool|null $requestContact If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only
 * @property-read bool|null $requestLocation If True, the user's current location will be sent when the button is pressed. Available in private chats only
 * @property-read KeyboardButtonPoll|null $requestPoll If specified, the user will be asked to create a poll and send it to the bot when the button is pressed. Available in private chats only
 * @property-read WebAppInfo|null $webApp If specified, the described Web App will be launched when the button is pressed. The Web App will be able to send a “web_app_data” service message. Available in private chats only
 *
 * @method self setText(string $text)
 * @method self setRequestContact(bool $requestContact = true)
 * @method self setRequestLocation(bool $requestLocation = true)
 * @method self setRequestPoll(KeyboardButtonPoll $requestPoll)
 * @method self setWebApp(WebAppInfo $webApp)
 */
class KeyboardButton extends Type
{
    protected string $text;
    protected ?bool $requestContact;
    protected ?bool $requestLocation;
    protected ?KeyboardButtonPoll $requestPoll;
    protected ?WebAppInfo $webApp;

    public static function init(array $data): self
    {
        $button = new self();

        $button->text = $data['text'];
        $button->requestContact = $data['request_contact'] ?? null;
        $button->requestLocation = $data['request_location'] ?? null;
        $button->requestPoll = !empty($data['request_poll']) ? KeyboardButtonPoll::init($data['request_poll']) : null;
        $button->webApp = !empty($data['web_app']) ? WebAppInfo::init($data['web_app']) : null;

        return $button;
    }


}
