<?php


namespace Vashakidze\Telegram\Api\Types;


use JsonSerializable;
use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Exceptions\TelegramArgsException;

/**
 * Class ForceReply
 * @package Vashakidze\Telegram\Api\Types
 *
 * Upon receiving a message with this object, Telegram clients will display a reply interface to the user (act as if the
 * user has selected the bot's message and tapped 'Reply'). This can be extremely useful if you want to create
 * user-friendly step-by-step interfaces without having to sacrifice privacy mode.
 *
 * @link https://core.telegram.org/bots/api#forcereply
 *
 * @property-read bool $forceReply Shows reply interface to the user, as if they manually selected the bot's message and tapped 'Reply'
 * @property-read string|null $inputFieldPlaceholder The placeholder to be shown in the input field when the reply is active; 1-64 characters
 * @property-read bool|null $selective Use this parameter if you want to force reply from specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
 *
 * @method self setForceReply(bool $forceReply = true)
 * @method self setSelective(bool $selective = true)
 */
class ForceReply extends Type implements JsonSerializable
{
    protected bool $forceReply = true;
    protected ?string $inputFieldPlaceholder;
    protected ?bool $selective;

    public static function init(array $data): self
    {
        $forceReply = new self();

        $forceReply->forceReply = $data['force_reply'];
        $forceReply->inputFieldPlaceholder = $data['input_field_placeholder'] ?? null;
        $forceReply->selective = $data['selective'] ?? null;

        return $forceReply;
    }

    /**
     * @param string $inputFieldPlaceholder
     * @return $this
     * @throws TelegramArgsException
     */
    public function setInputFieldPlaceholder(string $inputFieldPlaceholder): self
    {
        $length = strlen($inputFieldPlaceholder);

        if ($length < 1 || $length > 64) {
            throw new TelegramArgsException('Field "inputFieldPlaceholder" must be 1-64 characters');
        }

        $this->inputFieldPlaceholder = $inputFieldPlaceholder;

        return $this;
    }

    /**
     * @return array
     * @throws TelegramArgsException
     */
    public function jsonSerialize(): array
    {
        return $this->toRequest();
    }
}
