<?php


namespace Vashakidze\Telegram\Api\Enums;


use BenSampo\Enum\Enum;
use Illuminate\Support\Str;
use Vashakidze\Telegram\Api\Types\Poll;
use Vashakidze\Telegram\Api\Types\PreCheckoutQuery;
use Vashakidze\Telegram\Events\TelegramCallbackQueryEvent;
use Vashakidze\Telegram\Events\TelegramChannelPostEvent;
use Vashakidze\Telegram\Events\TelegramChatJoinRequestEvent;
use Vashakidze\Telegram\Events\TelegramChatMemberEvent;
use Vashakidze\Telegram\Events\TelegramChosenInlineResultEvent;
use Vashakidze\Telegram\Events\TelegramEditedChannelPostEvent;
use Vashakidze\Telegram\Events\TelegramEditMessageEvent;
use Vashakidze\Telegram\Events\TelegramInlineQueryEvent;
use Vashakidze\Telegram\Events\TelegramMessageEvent;
use Vashakidze\Telegram\Events\TelegramMyChatMemberEvent;
use Vashakidze\Telegram\Events\TelegramPollAnswerEvent;
use Vashakidze\Telegram\Events\TelegramShippingQueryEvent;

/**
 * Class TelegramWebhookAllowedUpdates
 * @package Vashakidze\Telegram\Enums
 *
 * @method static static message()
 * @method static static edited_message()
 * @method static static channel_post()
 * @method static static edited_channel_post()
 * @method static static inline_query()
 * @method static static chosen_inline_result()
 * @method static static callback_query()
 * @method static static shipping_query()
 * @method static static pre_checkout_query()
 * @method static static poll()
 * @method static static poll_answer()
 * @method static static my_chat_member()
 * @method static static chat_member()
 * @method static static chat_join_request()
 */
class WebhookUpdateType extends Enum
{
    public const message = 'message';
    public const edited_message = 'edited_message';
    public const channel_post = 'channel_post';
    public const edited_channel_post = 'edited_channel_post';
    public const inline_query = 'inline_query';
    public const chosen_inline_result = 'chosen_inline_result';
    public const callback_query = 'callback_query';
    public const shipping_query = 'shipping_query';
    public const pre_checkout_query = 'pre_checkout_query';
    public const poll = 'poll';
    public const poll_answer = 'poll_answer';
    public const my_chat_member = 'my_chat_member';
    public const chat_member = 'chat_member';
    public const chat_join_request = 'chat_join_request';

    private static array $events = [
        self::message => TelegramMessageEvent::class,
        self::edited_message => TelegramEditMessageEvent::class,
        self::channel_post => TelegramChannelPostEvent::class,
        self::edited_channel_post => TelegramEditedChannelPostEvent::class,
        self::inline_query => TelegramInlineQueryEvent::class,
        self::chosen_inline_result => TelegramChosenInlineResultEvent::class,
        self::callback_query => TelegramCallbackQueryEvent::class,
        self::shipping_query => TelegramShippingQueryEvent::class,
        self::pre_checkout_query => PreCheckoutQuery::class,
        self::poll => Poll::class,
        self::poll_answer => TelegramPollAnswerEvent::class,
        self::my_chat_member => TelegramMyChatMemberEvent::class,
        self::chat_member => TelegramChatMemberEvent::class,
        self::chat_join_request => TelegramChatJoinRequestEvent::class,
    ];

    public function toSetMethodName(): string
    {
        return 'set' . Str::studly($this->value);
    }

    public function toPropertyName(): string
    {
        return Str::camel($this->value);
    }

    public function getEvent(): string
    {
        return self::$events[$this->value];
    }
}
