<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class PassportData
 * @package Vashakidze\Telegram\Api\Types
 *
 * Contains information about Telegram Passport data shared with the bot by the user
 *
 * @link https://core.telegram.org/bots/api#passportdata
 *
 * @property-read EncryptedPassportElement[] $data Array with information about documents and other Telegram Passport elements that was shared with the bot
 * @property-read EncryptedCredentials $credentials Encrypted credentials required to decrypt the data
 */
class PassportData extends Type
{
    protected array $data;
    protected EncryptedCredentials $credentials;

    public static function init(array $data): self
    {
        $passportData = new self();

        $passportData->data = [];

        foreach ($data['data'] as $datum) {
            $passportData->data[] = EncryptedPassportElement::init($datum);
        }

        $passportData->credentials = EncryptedCredentials::init($data['credentials']);

        return $passportData;
    }
}
