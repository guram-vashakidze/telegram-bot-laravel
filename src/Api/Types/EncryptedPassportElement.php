<?php


namespace Vashakidze\Telegram\Api\Types;


use Illuminate\Support\Str;
use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Api\Enums\EncryptedPassportElementType;

/**
 * Class TelegramEncryptedPassportElementType
 * @package Vashakidze\Telegram\Api\Types
 *
 * Contains information about documents or other Telegram Passport elements shared with the bot by the user.
 *
 * @link https://core.telegram.org/bots/api#encryptedpassportelement
 *
 * @property-read EncryptedPassportElementType $type Element type
 * @property-read string $data Base64-encoded encrypted Telegram Passport element data provided by the user, available for “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport” and “address” types. Can be decrypted and verified using the accompanying EncryptedCredentials
 * @property-read string|null $phoneNumber User's verified phone number, available only for “phone_number” type
 * @property-read string|null $email User's verified email address, available only for “email” type
 * @property-read PassportFile[]|null $files Array of encrypted files with documents provided by the user, available for “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials
 * @property-read PassportFile|null $frontSide Encrypted file with the front side of the document, provided by the user. Available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials
 * @property-read PassportFile|null $reverseSide Encrypted file with the reverse side of the document, provided by the user. Available for “driver_license” and “identity_card”. The file can be decrypted and verified using the accompanying EncryptedCredentials
 * @property-read PassportFile|null $selfie Encrypted file with the selfie of the user holding a document, provided by the user; available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials
 * @property-read PassportFile|null $translation Array of encrypted files with translated versions of documents provided by the user. Available if requested for “passport”, “driver_license”, “identity_card”, “internal_passport”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials
 * @property-read string $hash Base64-encoded element hash for using in PassportElementErrorUnspecified
 */
class EncryptedPassportElement extends Type
{
    protected EncryptedPassportElementType $type;
    protected string $data;
    protected ?string $phoneNumber;
    protected ?string $email;
    protected ?array $files;
    protected ?PassportFile $frontSide;
    protected ?PassportFile $reverseSide;
    protected ?PassportFile $selfie;
    protected ?array $translation;
    protected string $hash;

    public static function init(array $data): self
    {
        $passportElement = new self();

        $passportElement->type = EncryptedPassportElementType::fromValue($data['type']);
        $passportElement->data = $data['data'];
        $passportElement->phoneNumber = $data['phone_number'] ?? null;
        $passportElement->email = $data['email'] ?? null;

        $passportElement->setPassportFiles($data, 'files');

        $passportElement->frontSide = !empty($data['front_side']) ? PassportFile::init($data['front_side']) : null;
        $passportElement->reverseSide = !empty($data['reverse_side']) ? PassportFile::init($data['reverse_side']) : null;
        $passportElement->selfie = !empty($data['selfie']) ? PassportFile::init($data['selfie']) : null;

        $passportElement->setPassportFiles($data, 'translation');

        $passportElement->hash = $data['hash'];

        return $passportElement;
    }

    private function setPassportFiles(array $data, $field): void
    {
        $propertyName = Str::camel($field);

        /**
         * @see EncryptedPassportElement::$files
         * @see EncryptedPassportElement::$translations
         */
        $this->{$propertyName} = null;

        if (empty($data[$field])) {
            return;
        }

        $this->{$propertyName} = [];

        foreach ($data[$field] as $file) {
            $this->{$propertyName}[] = PassportFile::init($file);
        }
    }
}
