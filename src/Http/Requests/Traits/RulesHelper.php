<?php


namespace Vashakidze\Telegram\Http\Requests\Traits;


use function array_pop;
use function explode;
use function in_array;
use function rtrim;
use function count;

/**
 * Trait RulesHelper
 * @package Vashakidze\Telegram\Http\Requests\Traits
 */
trait RulesHelper
{
    protected function getSetting(?string $prefix): array
    {
        return [
            $prefix ? rtrim($prefix, ".") . "." : '',
            !$prefix ? "required" : "required_with:" . rtrim($prefix, ".*")
        ];
    }

    protected function isRepeat(?string $prefix): bool
    {
        if (empty($prefix)) {
            return false;
        }

        $prefix = explode(".", rtrim($prefix, ".*"));

        if (count($prefix) === 1) {
            return false;
        }

        $last = array_pop($prefix);

        return in_array($last, $prefix);
    }
}
