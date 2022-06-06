<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;

/**
 * Trait VideoRules
 * @package Vashakidze\Telegram\Http\Requests\Traits
 *
 * @link https://core.telegram.org/bots/api#video
 */
trait VideoRules
{
    use AnimationRules;

    protected function getVideoRules(?string $prefix = null): array
    {
        return $this->getAnimationRules($prefix);
    }
}
