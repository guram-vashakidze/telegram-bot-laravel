<?php


namespace Vashakidze\Telegram\Api\Types;

use Vashakidze\Telegram\Api\Type;

use function array_key_exists;

/**
 * Class User
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a Telegram user or bot
 *
 * @link https://core.telegram.org/bots/api#user
 *
 * @property-read int $id - Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
 * @property-read bool $isBot - True, if this user is a bot
 * @property-read string $firstName - User's or bot's first name
 * @property-read string|null $lastName - User's or bot's last name
 * @property-read string|null $username - User's or bot's username
 * @property-read string|null $languageCode - IETF language tag of the user's language
 * @property-read bool|null $canJoinGroups - True, if the bot can be invited to groups. Returned only in getMe.
 * @property-read bool|null $canReadAllGroupMessages - True, if privacy mode is disabled for the bot. Returned only in getMe.
 * @property-read bool|null $supportsInlineQueries - True, if the bot supports inline queries. Returned only in getMe.
 *
 * @method self setId(int $id)
 * @method self setIsBoot(bool $isBot)
 * @method self setFirstName(string $firstName)
 * @method self setLastName(string $lastName)
 * @method self setUsername(string $username)
 * @method self setLanguageCode(string $languageCode)
 * @method self setCanJoinGroups(bool $canJoinGroups)
 * @method self setCanReadAllGroupMessages(bool $canReadAllGroupMessages)
 * @method self setSupportsInlineQueries(bool $canSupportsInlineQueries)
 */
class User extends Type
{
    protected int $id;
    protected bool $isBot;
    protected string $firstName;
    protected ?string $lastName;
    protected ?string $username;
    protected ?string $languageCode;
    protected ?bool $canJoinGroups;
    protected ?bool $canReadAllGroupMessages;
    protected ?bool $supportsInlineQueries;

    public static function init(array $data): self
    {
        $user = new self();

        $user->id = (int)$data['id'];
        $user->isBot = (bool)$data['is_bot'];
        $user->firstName = $data['first_name'];
        $user->lastName = $data['last_name'] ?? null;
        $user->username = $data['username'] ?? null;
        $user->languageCode = $data['language_code'] ?? null;
        $user->canJoinGroups = array_key_exists('can_join_groups', $data) ? (bool)$data['can_join_groups'] : null;
        $user->canReadAllGroupMessages = array_key_exists(
            'can_read_all_group_messages',
            $data
        ) ? (bool)$data['can_read_all_group_messages'] : null;
        $user->supportsInlineQueries = array_key_exists(
            'supports_inline_queries',
            $data
        ) ? (bool)$data['supports_inline_queries'] : null;

        return $user;
    }
}
