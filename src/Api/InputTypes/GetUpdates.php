<?php


namespace Vashakidze\Telegram\Api\InputTypes;


use Vashakidze\Telegram\Api\InputType;

/**
 * Class TelegramGetUpdatesInputType
 * @package Vashakidze\Telegram\Api\InputTypes
 *
 * Use this method to receive incoming updates using long polling (wiki). An Array of Update objects is returned
 *
 * @link https://core.telegram.org/bots/api#getupdates
 *
 * @property-read int|null $offset Identifier of the first update to be returned
 * @property-read int|null $limit Limits the number of updates to be retrieved. Values between 1-100 are accepted. Defaults to 100
 * @property-read int|null $timeout Timeout in seconds for long polling. Defaults to 0, i.e. usual short polling. Should be positive, short polling should be used for testing purposes only
 * @property-read string|null $allowedUpdates A JSON-serialized list of the update types you want your bot to receive. For example, specify [“message”, “edited_channel_post”, “callback_query”] to only receive updates of these types
 */
class GetUpdates extends InputType
{
    protected ?int $offset = null;
    protected ?int $limit = null;
    protected ?int $timeout = null;
    protected ?string $allowedUpdates = null;
}
