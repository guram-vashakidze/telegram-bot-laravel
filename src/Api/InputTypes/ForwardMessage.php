<?php


namespace Vashakidze\Telegram\Api\InputTypes;


use Vashakidze\Telegram\Api\InputType;

/**
 * Class ForwardMessage
 * @package Vashakidze\Telegram\Api\InputTypes
 *
 * Use this method to forward messages of any kind. Service messages can't be forwarded. On success, the sent Message is returned
 *
 * @link https://core.telegram.org/bots/api#forwardmessage
 *
 * @property-read int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
 * @property-read int|string $fromChatId Unique identifier for the chat where the original message was sent (or channel username in the format @channelusername)
 * @property-read int $messageId Message identifier in the chat specified in from_chat_id
 * @property-read bool|null $disableNotification Sends the message silently. Users will receive a notification with no sound.
 * @property-read bool|null $protectContent Protects the contents of the forwarded message from forwarding and saving
 *
 * @method self setChatId(int|string $chatId)
 * @method self setFromChatId(int|string $fromChatId)
 * @method self setMessageId(int $messageId)
 * @method self setDisableNotification(bool $disableNotification = true)
 * @method self setProtectContent(bool $protectContent = true)
 */
class ForwardMessage extends InputType
{
    protected int|string $chatId;
    protected int|string $fromChatId;
    protected int $messageId;
    protected ?bool $disableNotification;
    protected ?bool $protectContent;
}
