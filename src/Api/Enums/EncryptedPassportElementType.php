<?php


namespace Vashakidze\Telegram\Api\Enums;


use BenSampo\Enum\Enum;

/**
 * Class EncryptedPassportElementType
 * @package Vashakidze\Telegram\Api\Enums
 *
 * @link https://core.telegram.org/bots/api#encryptedpassportelement
 *
 * @method static static personal_details()
 * @method static static passport()
 * @method static static driver_license()
 * @method static static identity_card()
 * @method static static internal_passport()
 * @method static static address()
 * @method static static utility_bill()
 * @method static static bank_statement()
 * @method static static rental_agreement()
 * @method static static passport_registration()
 * @method static static temporary_registration()
 * @method static static phone_number()
 * @method static static email()
 */
class EncryptedPassportElementType extends Enum
{
    public const personal_details = 'personal_details';
    public const passport = 'passport';
    public const driver_license = 'driver_license';
    public const identity_card = 'identity_card';
    public const internal_passport = 'internal_passport';
    public const address = 'address';
    public const utility_bill = 'utility_bill';
    public const bank_statement = 'bank_statement';
    public const rental_agreement = 'rental_agreement';
    public const passport_registration = 'passport_registration';
    public const temporary_registration = 'temporary_registration';
    public const phone_number = 'phone_number';
    public const email = 'email';
}
