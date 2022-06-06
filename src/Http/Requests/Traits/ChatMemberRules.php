<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

use BenSampo\Enum\Rules\EnumValue;
use Vashakidze\Telegram\Api\Enums\ChatMemberStatus;

use function array_merge;

/**
 * Trait ChatMemberRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#chatmember
 */
trait ChatMemberRules
{
    use RulesHelper;
    use UserRules;

    protected function getChatMemberRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'status' => [
                    $required,
                    'string',
                    new EnumValue(ChatMemberStatus::class)
                ],
                $prefix . 'user' => [
                    $required,
                    'array',
                ],
                $prefix . 'is_anonymous' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::creator . ',' . ChatMemberStatus::administrator,
                    'bool'
                ],
                $prefix . 'custom_title' => [
                    'nullable',
                    'string'
                ],
                $prefix . 'can_be_edited' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::administrator,
                    'bool'
                ],
                $prefix . 'can_manage_chat' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::administrator,
                    'bool'
                ],
                $prefix . 'can_delete_messages' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::administrator,
                    'bool'
                ],
                $prefix . 'can_manage_video_chats' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::administrator,
                    'bool'
                ],
                $prefix . 'can_restrict_members' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::administrator,
                    'bool'
                ],
                $prefix . 'can_promote_members' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::administrator,
                    'bool'
                ],
                $prefix . 'can_change_info' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::administrator . ',' . ChatMemberStatus::restricted,
                    'bool'
                ],
                $prefix . 'can_invite_users' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::administrator . ',' . ChatMemberStatus::restricted,
                    'bool'
                ],
                $prefix . 'can_post_messages' => [
                    'nullable',
                    'bool'
                ],
                $prefix . 'can_edit_messages' => [
                    'nullable',
                    'bool'
                ],
                $prefix . 'can_pin_messages' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::restricted,
                    'bool'
                ],
                $prefix . 'can_send_messages' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::restricted,
                    'bool'
                ],
                $prefix . 'can_send_media_messages' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::restricted,
                    'bool'
                ],
                $prefix . 'can_send_polls' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::restricted,
                    'bool'
                ],
                $prefix . 'can_send_other_messages' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::restricted,
                    'bool'
                ],
                $prefix . 'can_add_web_page_previews' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::restricted,
                    'bool'
                ],
                $prefix . 'until_date' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::restricted . ',' . ChatMemberStatus::kicked,
                    'int'
                ],
                $prefix . 'custom_title' => [
                    'nullable',
                    'string'
                ],
                $prefix . 'is_member' => [
                    'required_if:' . $prefix . 'status,' . ChatMemberStatus::restricted,
                    'bool'
                ],
            ],
            $this->getUserRules($prefix . 'user')
        );
    }
}
