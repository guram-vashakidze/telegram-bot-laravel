<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Api\Enums\MessageEntityType;

/**
 * Class MessageEntity
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 *
 * @link https://core.telegram.org/bots/api#messageentity
 *
 * @property-read MessageEntityType $type Type of the entity
 * @property-read int $offset Offset in UTF-16 code units to the start of the entity
 * @property-read int $length Length of the entity in UTF-16 code units
 * @property-read string|null $url For “text_link” only, url that will be opened after user taps on the text
 * @property-read User|null $user For “text_mention” only, the mentioned user
 * @property-read string|null $language For “pre” only, the programming language of the entity text
 *
 * @method self setType(MessageEntityType $type)
 * @method self setOffset(int $offset)
 * @method self setLength(int $length)
 * @method self setUrl(int $url)
 * @method self setUser(User $user)
 * @method self setLanguage(string $language)
 */
class MessageEntity extends Type
{
    protected MessageEntityType $type;
    protected int $offset;
    protected int $length;
    protected ?string $url;
    protected ?User $user;
    protected ?string $language;

    public static function init(array $data): self
    {
        $messageEntity = new self();

        $messageEntity->type = MessageEntityType::fromValue($data['type']);
        $messageEntity->offset = $data['offset'];
        $messageEntity->length = $data['length'];
        $messageEntity->url = $data['url'] ?? null;
        $messageEntity->user = !empty($data['user']) ? User::init($data['user']) : null;
        $messageEntity->language = $data['language'] ?? null;

        return $messageEntity;
    }
}
