<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

use function array_merge;

/**
 * Trait ChatInviteLinkRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#chatinvitelink
 */
trait ChatInviteLinkRules
{
    use RulesHelper;
    use UserRules;

    protected function getChatInviteLinkRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'invite_link' => [
                    $required,
                    'string',
                ],
                $prefix . 'creator' => [
                    $required,
                    'array',
                ],
                $prefix . 'creates_join_request' => [
                    $required,
                    'bool',
                ],
                $prefix . 'is_primary' => [
                    $required,
                    'bool',
                ],
                $prefix . 'is_revoked' => [
                    $required,
                    'bool',
                ],
                $prefix . 'name' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'expire_date' => [
                    'nullable',
                    'int',
                ],
                $prefix . 'member_limit' => [
                    'nullable',
                    'int',
                ],
                $prefix . 'pending_join_request_count' => [
                    'nullable',
                    'int',
                ],
            ],
            $this->getUserRules($prefix . 'creator')
        );
    }
}
