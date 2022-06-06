<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class EncryptedCredentials
 * @package Vashakidze\Telegram\Api\Types
 *
 * Contains data required for decrypting and authenticating EncryptedPassportElement. See the Telegram Passport Documentation for a complete description of the data decryption and authentication processes.
 *
 * @link https://core.telegram.org/bots/api#encryptedcredentials
 *
 * @property-read string $data Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and secrets required for EncryptedPassportElement decryption and authentication
 * @property-read string $hash Base64-encoded data hash for data authentication
 * @property-read string $secret Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption
 */
class EncryptedCredentials extends Type
{
    protected string $data;
    protected string $hash;
    protected string $secret;

    public static function init(array $data): self
    {
        $credentials = new self();

        $credentials->data = $data['data'];
        $credentials->hash = $data['hash'];
        $credentials->secret = $data['secret'];

        return $credentials;
    }
}
