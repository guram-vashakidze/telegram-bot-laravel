<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class MaskPosition
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object describes the position on faces where a mask should be placed by default.
 *
 * @link https://core.telegram.org/bots/api#maskposition
 *
 * @property-read string $point The part of the face relative to which the mask should be placed. One of “forehead”, “eyes”, “mouth”, or “chin”
 * @property-read float $xShift Shift by X-axis measured in widths of the mask scaled to the face size, from left to right. For example, choosing -1.0 will place mask just to the left of the default mask position
 * @property-read float $yShift Shift by Y-axis measured in heights of the mask scaled to the face size, from top to bottom. For example, 1.0 will place the mask just below the default mask position
 * @property-read float $scale Mask scaling coefficient. For example, 2.0 means double size
 */
class MaskPosition extends Type
{
    protected string $point;
    protected float $xShift;
    protected float $yShift;
    protected float $scale;

    public static function init(array $data): self
    {
        $maskPosition = new self();

        $maskPosition->point = $data['point'];
        $maskPosition->xShift = (float)$data['x_shift'];
        $maskPosition->yShift = (float)$data['y_shift'];
        $maskPosition->scale = (float)$data['scale'];

        return $maskPosition;
    }
}
