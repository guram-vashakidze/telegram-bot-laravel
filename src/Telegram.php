<?php


namespace Vashakidze\Telegram;


use Illuminate\Support\Facades\Facade;
use Vashakidze\Telegram\Api\InputTypes\CopyMessage;
use Vashakidze\Telegram\Api\InputTypes\ForwardMessage;
use Vashakidze\Telegram\Api\InputTypes\GetUpdates;
use Vashakidze\Telegram\Api\InputTypes\SendAnimation;
use Vashakidze\Telegram\Api\InputTypes\SendAudio;
use Vashakidze\Telegram\Api\InputTypes\SendDocument;
use Vashakidze\Telegram\Api\InputTypes\SendMessage;
use Vashakidze\Telegram\Api\InputTypes\SendPhoto;
use Vashakidze\Telegram\Api\InputTypes\SendVideo;
use Vashakidze\Telegram\Api\InputTypes\SendVideoNote;
use Vashakidze\Telegram\Api\InputTypes\SendVoice;
use Vashakidze\Telegram\Api\InputTypes\SetWebhook;
use Vashakidze\Telegram\Api\Types\MessageId;
use Vashakidze\Telegram\Api\Types\Message;
use Vashakidze\Telegram\Api\Types\Update;
use Vashakidze\Telegram\Api\Types\User;
use Vashakidze\Telegram\Api\Types\WebhookInfo;

/**
 * Class Telegram
 * @package Vashakidze\Telegram
 *
 * @see TelegramApi
 *
 * @link https://core.telegram.org/bots/api
 *
 * @method static User getMe()
 * @method static bool close()
 * @method static WebhookInfo getWebhookInfo()
 * @method static bool setWebhook(SetWebhook $args)
 * @method static bool deleteWebhook()
 * @method static Update[]|null getUpdates(?GetUpdates $args = null)
 * @method static Message sendMessage(SendMessage $args)
 * @method static Message forwardMessage(ForwardMessage $args)
 * @method static MessageId copyMessage(CopyMessage $args)
 * @method static Message sendPhoto(SendPhoto $args)
 * @method static Message sendAudio(SendAudio $args)
 * @method static Message sendDocument(SendDocument $args)
 * @method static Message sendVideo(SendVideo $args)
 * @method static Message sendAnimation(SendAnimation $args)
 * @method static Message sendVoice(SendVoice $args)
 * @method static Message sendVideoNote(SendVideoNote $args)
 */
class Telegram extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'vashakidze_telegram';
    }
}
