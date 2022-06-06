<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_merge;

/**
 * Trait GameRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#game
 */
trait GameRules
{
    use RulesHelper;
    use PhotoSizeRules;
    use MessageEntityRules;
    use AnimationRules;

    protected function getGameRules(?string $prefix = null): array
    {
        [$prefix, $required] = $this->getSetting($prefix);

        return array_merge(
            [
                $prefix . 'title' => [
                    $required,
                    'string',
                ],
                $prefix . 'description' => [
                    $required,
                    'string',
                ],
                $prefix . 'photo' => [
                    $required,
                    'array',
                ],
                $prefix . 'text' => [
                    'nullable',
                    'string',
                ],
                $prefix . 'text_entities' => [
                    'nullable',
                    'array',
                ],
                $prefix . 'animation' => [
                    'nullable',
                    'array',
                ],
            ],
            $this->getPhotoSizeRules($prefix . 'photo.*'),
            $this->getMessageEntityRules($prefix . 'text_entities.*'),
            $this->getAnimationRules($prefix . 'animation'),
        );
    }
}
