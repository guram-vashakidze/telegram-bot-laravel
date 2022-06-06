<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


/**
 * Trait EncryptedCredentialsRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#encryptedcredentials
 */
trait EncryptedCredentialsRules
{
    use RulesHelper;

    protected function getEncryptedCredentialsRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'data' => [
                $required,
                'string',
            ],
            $prefix . 'hash' => [
                'nullable',
                'string',
            ],
            $prefix . 'secret' => [
                'nullable',
                'string',
            ],
        ];
    }
}
