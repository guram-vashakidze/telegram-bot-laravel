<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use BenSampo\Enum\Rules\EnumValue;
use Vashakidze\Telegram\Api\Enums\ChatType;

use function array_merge;

/**
 * Trait ChatRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#chat
 */
trait ChatRules
{
    use RulesHelper;
    use ChatLocationRules;
    use ChatPermissionsRules;
    use ChatPhotoRules;

    protected function getChatRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                'id' => [
                    $required,
                    'int',
                ],
                $prefix . 'type' => [
                    $required,
                    'string',
                    new EnumValue(ChatType::class)
                ],
                $prefix . 'title' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'username' => [
                    'nullable',
                    'string'
                ],
                $prefix . 'first_name' => [
                    'nullable',
                    'string'
                ],
                $prefix . 'last_name' => [
                    'nullable',
                    'string'
                ],
                $prefix . 'photo' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'has_private_forwards' => [
                    'nullable',
                    'bool',
                ],
                $prefix . 'description' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'invite_link' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'pinned_message' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'permissions' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'slow_mode_delay' => [
                    'nullable',
                    'int',
                ],
                $prefix . 'message_auto_delete_time' => [
                    'nullable',
                    'int',
                ],
                $prefix . 'has_protected_content' => [
                    'nullable',
                    'true',
                ],
                $prefix . 'sticker_set_name' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'can_set_sticker_set' => [
                    'nullable',
                    'boolean'
                ],
                $prefix . 'linked_chat_id' => [
                    'nullable',
                    'int',
                ],
                $prefix . 'location' => [
                    'nullable',
                    'array'
                ]
            ],
            $this->getMessageRules($prefix . 'pinned_message'),
            $this->getChatPermissionsRules($prefix . 'permissions'),
            $this->getChatPhotoRules($prefix . 'photo'),
            $this->getChatLocationRules($prefix . 'location')
        );
    }
}
