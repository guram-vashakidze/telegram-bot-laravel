<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait ChatJoinRequestRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#chatjoinrequest
 */
trait ChatJoinRequestRules
{
    use RulesHelper;
    use ChatRules;
    use UserRules;
    use ChatInviteLinkRules;

    protected function getChatJoinRequestRules(?string $prefix = null): array
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
                $prefix . 'bio' => [
                    'nullable',
                    'string'
                ],
                $prefix . 'invite_link' => [
                    'nullable',
                    'array'
                ],
            ],
            $this->getChatRules($prefix . 'chat'),
            $this->getUserRules($prefix . 'from'),
            $this->getChatInviteLinkRules($prefix . 'invite_link')
        );
    }
}
