<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait CallBackQueryRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#callbackquery
 */
trait CallBackQueryRules
{
    use RulesHelper;
    use MessageRules;
    use UserRules;

    protected function getCallBackQueryRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'id' => [
                    $required,
                    'string',
                ],
                $prefix . 'from' => [
                    $required,
                    'array',
                ],
                $prefix . 'message' => [
                    'nullable',
                    'array'
                ],
                $prefix . 'inline_message_id' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'chat_instance' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'data' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'game_short_name' => [
                    'nullable',
                    'string'
                ]
            ],
            $this->getUserRules($prefix . 'from'),
            $this->getMessageRules($prefix . 'message'),
        );
    }
}
