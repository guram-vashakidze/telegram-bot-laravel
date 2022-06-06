<?php


namespace Vashakidze\Telegram;


use Closure;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
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
use Vashakidze\Telegram\Api\InputType;
use Vashakidze\Telegram\Api\InputTypes\InputFile;
use Vashakidze\Telegram\Api\Types\MessageId;
use Vashakidze\Telegram\Api\Types\Message;
use Vashakidze\Telegram\Api\Types\Update;
use Vashakidze\Telegram\Api\Types\User;
use Vashakidze\Telegram\Api\Types\WebhookInfo;
use Vashakidze\Telegram\Exceptions\TelegramApiException;
use Vashakidze\Telegram\Exceptions\TelegramArgsException;

use function array_map;

/**
 * Class TelegramApi
 * @package Vashakidze\Telegram
 *
 * @author Guram Vashakidze
 *
 *
 */
class TelegramApi
{
    /**
     * @var string $url Telegram api url
     */
    protected string $url;

    /**
     * @var string $token Telegram bot token from env(TELEGRAM_API_TOKEN)
     */
    protected string $token;

    public function __construct()
    {
        $this->url = rtrim(config('telegram.api.url'), '/') . '/';
        $this->token = config('telegram.api.token');
    }

    /**
     * @param string $method
     * @param bool $post
     * @param array|null $args
     * @return array
     * @throws TelegramApiException
     */
    private function sendRequest(string $method, bool $post = false, ?array $args = null): mixed
    {
        $request = Http::acceptJson();

        $url = $this->getUrl($method);

        return $this->thrownResponse(
            fn () => !$post ? $request->get($url, $args) : $request->asJson()
                ->post($url, $args)
        );
    }

    /**
     * @param string $method
     * @param InputFile|InputFile[] $file
     * @param array $args
     * @return mixed
     * @throws TelegramApiException
     */
    private function sendMultipartRequest(string $method, array $file, array $args): mixed
    {
        $request = Http::acceptJson();

        foreach ($file as $item) {
            $request->attach($item->name, $item->contents, $item->filename);
        }

        return $this->thrownResponse(
            fn () => $request
                ->post($this->getUrl($method), $args)
        );
    }

    private function getUrl(string $method): string
    {
        return sprintf("%sbot%s/%s", $this->url, $this->token, $method);
    }

    /**
     * @param Closure $closure
     * @return mixed
     * @throws TelegramApiException
     */
    private function thrownResponse(Closure $closure): mixed
    {
        try {
            /** @var Response $response */
            $response = $closure();
        } catch (RequestException $exception) {
            throw new TelegramApiException(
                [
                    'response_code' => $exception->getResponse()
                        ->getStatusCode(),
                    'message' => $exception->getMessage()
                ]
            );
        } catch (ConnectionException $exception) {
            throw new TelegramApiException(
                [
                    'response_code' => null,
                    'message' => $exception->getMessage()
                ]
            );
        }

        if (!$response->successful()) {
            throw new TelegramApiException(
                [
                    'response_code' => $response->json('error_code'),
                    'message' => $response->json('description')
                ]
            );
        }

        return $response->json('result');
    }

    /**
     * @return User
     * @throws TelegramApiException
     *
     * @link https://core.telegram.org/bots/api#getme
     */
    public function getMe(): User
    {
        $response = $this->sendRequest(__FUNCTION__);

        return User::init($response);
    }

    /**
     * @return bool
     * @throws TelegramApiException
     *
     * @link https://core.telegram.org/bots/api#close
     */
    public function close(): bool
    {
        return (bool)$this->sendRequest(__FUNCTION__);
    }

    /**
     * @return bool
     * @throws TelegramApiException
     *
     * @link https://core.telegram.org/bots/api#logout
     */
    public function logOut(): bool
    {
        return (bool)$this->sendRequest(__FUNCTION__);
    }

    /**
     * @return WebhookInfo
     * @throws TelegramApiException
     *
     * @link https://core.telegram.org/bots/api#getwebhookinfo
     */
    public function getWebhookInfo(): WebhookInfo
    {
        return WebhookInfo::init(
            $this->sendRequest(__FUNCTION__)
        );
    }

    /**
     * @param SetWebhook $args
     * @return bool
     * @throws TelegramArgsException|TelegramApiException
     *
     * @link https://core.telegram.org/bots/api#setwebhook
     */
    public function setWebhook(SetWebhook $args): bool
    {
        if (!isset($args->certificate)) {
            return $this->sendRequest(__FUNCTION__, true, $args->toRequest());
        }

        $request = $args->toRequest();

        return $this->sendMultipartRequest(__FUNCTION__, $args->certificate, $request);
    }

    /**
     * @return bool
     * @throws TelegramApiException
     *
     * @link https://core.telegram.org/bots/api#deletewebhook
     */
    public function deleteWebhook(): bool
    {
        return $this->sendRequest(__FUNCTION__, true);
    }

    /**
     * @param GetUpdates|null $args
     * @return Update[]|null
     * @throws TelegramApiException
     * @throws TelegramArgsException
     *
     * Use this method to receive incoming updates using long polling (wiki). An Array of Update objects is returned
     *
     * @link https://core.telegram.org/bots/api#getupdates
     */
    public function getUpdates(?GetUpdates $args = null): ?array
    {
        $response = $this->sendRequest(method: __FUNCTION__, args: $args?->toRequest());

        if (empty($response)) {
            return null;
        }
        return array_map(
            fn (array $item) => Update::init($item),
            $response
        );
    }

    /**
     * @param SendMessage $args
     * @return Message
     * @throws TelegramApiException
     * @throws TelegramArgsException
     *
     * Use this method to send text messages. On success, the sent Message is returned
     *
     * @link https://core.telegram.org/bots/api#sendmessage
     */
    public function sendMessage(SendMessage $args): Message
    {
        return Message::init(
            $this->sendRequest(method: __FUNCTION__, args: $args->toRequest())
        );
    }

    /**
     * @param ForwardMessage $args
     * @return Message
     * @throws TelegramApiException
     * @throws TelegramArgsException
     *
     * Use this method to forward messages of any kind. Service messages can't be forwarded. On success, the sent Message is returned
     *
     * @link https://core.telegram.org/bots/api#forwardmessage
     */
    public function forwardMessage(ForwardMessage $args): Message
    {
        return Message::init(
            $this->sendRequest(method: __FUNCTION__, args: $args->toRequest())
        );
    }

    /**
     * @param CopyMessage $args
     * @return MessageId
     * @throws TelegramApiException
     * @throws TelegramArgsException
     *
     * Use this method to copy messages of any kind. Service messages and invoice messages can't be copied. The method
     * is analogous to the method forwardMessage, but the copied message doesn't have a link to the original message.
     * Returns the MessageId of the sent message on success
     *
     * @link https://core.telegram.org/bots/api#copymessage
     */
    public function copyMessage(CopyMessage $args): MessageId
    {
        return MessageId::init(
            $this->sendRequest(method: __FUNCTION__, args: $args->toRequest())
        );
    }

    /**
     * @param InputType $args
     * @param string $method
     * @return Message
     * @throws TelegramApiException
     * @throws TelegramArgsException
     */
    private function sendFile(InputType $args, string $method): Message
    {
        $request = $args->toRequest();

        if (!$args->isSetFiles()) {
            return Message::init(
                $this->sendRequest($method, true, $request)
            );
        }

        return Message::init(
            $this->sendMultipartRequest($method, $args->getFiles(), $request)
        );
    }

    /**
     * @param SendPhoto $args
     * @return Message
     * @throws TelegramApiException
     * @throws TelegramArgsException
     *
     * Use this method to send photos. On success, the sent Message is returned
     *
     * @link https://core.telegram.org/bots/api#sendphoto
     */
    public function sendPhoto(SendPhoto $args): Message
    {
        return $this->sendFile($args, __FUNCTION__);
    }

    /**
     * @param SendAudio $args
     * @return Message
     * @throws TelegramApiException
     * @throws TelegramArgsException
     *
     * Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio
     * must be in the .MP3 or .M4A format. On success, the sent Message is returned. Bots can currently send audio files
     * of up to 50 MB in size, this limit may be changed in the future
     *
     * @link https://core.telegram.org/bots/api#sendaudio
     */
    public function sendAudio(SendAudio $args): Message
    {
        return $this->sendFile($args, __FUNCTION__);
    }

    /**
     * @param SendDocument $args
     * @return Message
     * @throws TelegramApiException
     * @throws TelegramArgsException
     *
     * Use this method to send general files. On success, the sent Message is returned. Bots can currently send files of
     * any type of up to 50 MB in size, this limit may be changed in the future
     *
     * @link https://core.telegram.org/bots/api#senddocument
     */
    public function sendDocument(SendDocument $args): Message
    {
        return $this->sendFile($args, __FUNCTION__);
    }

    /**
     * @param SendVideo $args
     * @return Message
     * @throws TelegramApiException
     * @throws TelegramArgsException
     *
     * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document).
     * On success, the sent Message is returned. Bots can currently send video files of up to 50 MB in size, this limit
     * may be changed in the future
     *
     * @link https://core.telegram.org/bots/api#sendvideo
     */
    public function sendVideo(SendVideo $args): Message
    {
        return $this->sendFile($args, __FUNCTION__);
    }

    /**
     * @param SendAnimation $args
     * @return Message
     * @throws TelegramApiException
     * @throws TelegramArgsException
     *
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent
     * Message is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed
     * in the future
     *
     * @link https://core.telegram.org/bots/api#sendanimation
     */
    public function sendAnimation(SendAnimation $args): Message
    {
        return $this->sendFile($args, __FUNCTION__);
    }

    /**
     * @param SendVoice $args
     * @return Message
     * @throws TelegramApiException
     * @throws TelegramArgsException
     *
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message.
     * For this to work, your audio must be in an .OGG file encoded with OPUS (other formats may be sent as Audio or Document).
     * On success, the sent Message is returned. Bots can currently send voice messages of up to 50 MB in size, this limit
     * may be changed in the future
     *
     * @link https://core.telegram.org/bots/api#sendvoice
     */
    public function sendVoice(SendVoice $args): Message
    {
        return $this->sendFile($args, __FUNCTION__);
    }

    /**
     * @param SendVideoNote $args
     * @return Message
     * @throws TelegramApiException
     * @throws TelegramArgsException
     *
     * As of v.4.0, Telegram clients support rounded square mp4 videos of up to 1 minute long. Use this method to send
     * video messages. On success, the sent Message is returned
     *
     * @link https://core.telegram.org/bots/api#sendvideonote
     */
    public function sendVideoNote(SendVideoNote $args): Message
    {
        return $this->sendFile($args, __FUNCTION__);
    }
}
