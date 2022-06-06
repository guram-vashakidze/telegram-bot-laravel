<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class MessageId
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a unique message identifier
 *
 * @link https://core.telegram.org/bots/api#messageid
 *
 * @property-read int $messageId Unique message identifier
 *
 * @method self setMessageId(int $messageId)
 */
class MessageId extends Type
{
    protected int $messageId;

    public static function init(array $data): self
    {
        $messageId = new self();

        $messageId->messageId = $data['message_id'];

        return $messageId;
    }
}
