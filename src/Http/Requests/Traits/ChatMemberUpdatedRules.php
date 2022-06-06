<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait ChatMemberUpdatedRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#chatmemberupdated
 */
trait ChatMemberUpdatedRules
{
    use RulesHelper;
    use ChatRules;
    use UserRules;
    use ChatMemberRules;
    use ChatInviteLinkRules;

    protected function getChatMemberUpdatedRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'chat' => [
                    $required,
                    'array',
                ],
                $prefix . 'from' => [
                    $required,
                    'array',
                ],
                $prefix . 'date' => [
                    $required,
                    'int'
                ],
                $prefix . 'old_chat_member' => [
                    $required,
                    'array'
                ],
                $prefix . 'new_chat_member' => [
                    $required,
                    'array'
                ],
                $prefix . 'invite_link' => [
                    'nullable',
                    'array'
                ],
            ],
            $this->getChatRules($prefix . 'chat'),
            $this->getUserRules($prefix . 'from'),
            $this->getChatMemberRules($prefix . 'old_chat_member'),
            $this->getChatMemberRules($prefix . 'new_chat_member'),
            $this->getChatInviteLinkRules($prefix . 'invite_link')
        );
    }
}
