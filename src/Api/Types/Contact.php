<?php


namespace Vashakidze\Telegram\Api\Types;

use Vashakidze\Telegram\Api\Type;

/**
 * Class Contact
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a phone contact.
 *
 * @link https://core.telegram.org/bots/api#contact
 *
 * @property-read string $phoneNumber - Contact's phone number
 * @property-read string $firstName - Contact's first name
 * @property-read string|null $lastName - Contact's last name
 * @property-read int|null $userId - Contact's user identifier in Telegram. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier
 * @property-read string|null $vcard - Additional data about the contact in the form of a vCard
 */
class Contact extends Type
{
    protected string $phoneNumber;
    protected string $firstName;
    protected ?string $lastName;
    protected ?string $userId;
    protected ?string $vcard;

    public static function init(array $data): self
    {
        $user = new self();

        $user->phoneNumber = $data['phone_number'];
        $user->firstName = $data['first_name'];
        $user->lastName = $data['last_name'] ?? null;
        $user->userId = $data['user_id'] ?? null;
        $user->vcard = $data['vcard'] ?? null;

        return $user;
    }
}
