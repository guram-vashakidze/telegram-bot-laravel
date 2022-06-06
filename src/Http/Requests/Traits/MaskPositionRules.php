<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait MaskPositionRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#maskposition
 */
trait MaskPositionRules
{
    use RulesHelper;
    use PhotoSizeRules;

    protected function getMaskPositionRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return [
            $prefix . 'point' => [
                $required,
                'string',
            ],
            $prefix . 'x_shift' => [
                $required,
                'numeric',
            ],
            $prefix . 'y_shift' => [
                $required,
                'numeric',
            ],
            $prefix . 'scale' => [
                $required,
                'numeric',
            ],
        ];
    }
}
