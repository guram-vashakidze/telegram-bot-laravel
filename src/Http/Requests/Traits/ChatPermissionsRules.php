<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait ChatPermissionRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#chatpermissions
 */
trait ChatPermissionsRules
{
    use RulesHelper;

    protected function getChatPermissionsRules(?string $prefix = null): array
    {
        $prefix = $this->getSetting($prefix)[0];

        return [
            $prefix . 'can_send_messages' => [
                'nullable',
                'boolean'
            ],
            $prefix . 'can_send_media_messages' => [
                'nullable',
                'boolean'
            ],
            $prefix . 'can_send_polls' => [
                'nullable',
                'boolean'
            ],
            $prefix . 'can_send_other_messages' => [
                'nullable',
                'boolean'
            ],
            $prefix . 'can_add_web_page_previews' => [
                'nullable',
                'boolean'
            ],
            $prefix . 'can_change_info' => [
                'nullable',
                'boolean'
            ],
            $prefix . 'can_invite_users' => [
                'nullable',
                'boolean'
            ],
            $prefix . 'can_pin_messages' => [
                'nullable',
                'boolean'
            ],
        ];
    }
}
