<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait MessageAutoDeleteTimerChangedRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#messageautodeletetimerchanged
 */
trait MessageAutoDeleteTimerChangedRules
{
    use RulesHelper;
    use PhotoSizeRules;

    protected function getMessageAutoDeleteTimerChangedRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'message_auto_delete_time' => [
                $required,
                'int'
            ]
        ];
    }
}
