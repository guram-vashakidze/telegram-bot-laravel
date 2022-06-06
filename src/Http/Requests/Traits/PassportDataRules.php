<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait PassportDataRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#passportdata
 */
trait PassportDataRules
{
    use RulesHelper;
    use EncryptedPassportElementRules;
    use EncryptedCredentialsRules;

    protected function getPassportDataRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'data' => [
                    $required,
                    'array',
                ],
                $prefix . 'credentials' => [
                    $required,
                    'array',
                ],
            ],
            $this->getEncryptedPassportElementRules($prefix . 'data.*'),
            $this->getEncryptedCredentialsRules($prefix . 'credentials')
        );
    }
}
