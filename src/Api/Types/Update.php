<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Api\Enums\WebhookUpdateType;

/**
 * Class Update
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents an incoming update.
 *
 * @link https://core.telegram.org/bots/api#update
 *
 * @property-read int $updateId The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially
 * @property-read WebhookUpdateType $type Event type
 * @property-read Message|null $message New incoming message of any kind — text, photo, sticker, etc
 * @property-read Message|null $editedMessage New version of a message that is known to the bot and was edited
 * @property-read Message|null $channelPost New incoming channel post of any kind — text, photo, sticker, etc
 * @property-read Message|null $editedChannelPost New version of a channel post that is known to the bot and was edited
 * @property-read InlineQuery|null $inlineQuery New incoming inline query
 * @property-read ChosenInlineResult|null $chosenInlineResult The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot
 * @property-read CallbackQuery|null $callbackQuery New incoming callback query
 * @property-read ShippingQuery|null $shippingQuery New incoming shipping query. Only for invoices with flexible price
 * @property-read PreCheckoutQuery|null $preCheckoutQuery New incoming pre-checkout query. Contains full information about checkout
 * @property-read Poll|null $poll New poll state. Bots receive only updates about stopped polls and polls, which are sent by the bot
 * @property-read PollAnswer|null $pollAnswer A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself
 * @property-read ChatMemberUpdated|null $myChatMember The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user
 * @property-read ChatMemberUpdated|null $chatMember A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates
 * @property-read ChatJoinRequest|null $chatJoinRequest A request to join the chat has been sent. The bot must have the can_invite_users administrator right in the chat to receive these updates
 */
class Update extends Type
{
    protected int $updateId;
    protected WebhookUpdateType $type;
    protected ?Message $message = null;
    protected ?Message $editedMessage = null;
    protected ?Message $channelPost = null;
    protected ?Message $editedChannelPost = null;
    protected ?InlineQuery $inlineQuery = null;
    protected ?ChosenInlineResult $chosenInlineResult = null;
    protected ?CallbackQuery $callbackQuery = null;
    protected ?ShippingQuery $shippingQuery = null;
    protected ?PreCheckoutQuery $preCheckoutQuery = null;
    protected ?Poll $poll = null;
    protected ?PollAnswer $pollAnswer = null;
    protected ?ChatMemberUpdated $myChatMember = null;
    protected ?ChatMemberUpdated $chatMember = null;
    protected ?ChatJoinRequest $chatJoinRequest = null;

    public static function init(array $data): self
    {
        $update = new self();
        $update->updateId = (int)$data['update_id'];

        $update->setUpdateType($data);

        /**
         * @see Update::setMessage()
         * @see Update::setEditedMessage()
         * @see Update::setChannelPost()
         * @see Update::setEditedChannelPost()
         * @see Update::setInlineQuery()
         * @see Update::setChosenInlineResult()
         * @see Update::setCallbackQuery()
         * @see Update::setShippingQuery()
         * @see Update::setPreCheckoutQuery()
         * @see Update::setPoll()
         * @see Update::setPollAnswer()
         * @see Update::setMyChatMember()
         * @see Update::setChatMember()
         * @see Update::setChatJoinRequest()
         */
        $update->{$update->type->toSetMethodName()}($data[$update->type->value]);

        return $update;
    }

    private function setUpdateType(array $data): void
    {
        $result = array_values(
            array_intersect(config('telegram.webhook.setting.allowed_updates'), array_keys($data))
        );

        $this->type = WebhookUpdateType::fromValue($result[0]);
    }

    private function setMessage(array $data): void
    {
        $this->message = Message::init($data);
    }

    private function setEditedMessage(array $data): void
    {
        $this->editedMessage = Message::init($data);
    }

    private function setChannelPost(array $data): void
    {
        $this->channelPost = Message::init($data);
    }

    private function setEditedChannelPost(array $data): void
    {
        $this->editedChannelPost = Message::init($data);
    }

    private function setInlineQuery(array $data): void
    {
        $this->inlineQuery = InlineQuery::init($data);
    }

    private function setChosenInlineResult(array $data): void
    {
        $this->chosenInlineResult = ChosenInlineResult::init($data);
    }

    private function setCallbackQuery(array $data): void
    {
        $this->callbackQuery = CallbackQuery::init($data);
    }

    private function setShippingQuery(array $data): void
    {
        $this->shippingQuery = ShippingQuery::init($data);
    }

    private function setPreCheckoutQuery(array $data): void
    {
        $this->preCheckoutQuery = PreCheckoutQuery::init($data);
    }

    private function setPoll(array $data): void
    {
        $this->poll = Poll::init($data);
    }

    private function setPollAnswer(array $data): void
    {
        $this->pollAnswer = PollAnswer::init($data);
    }

    private function setMyChatMember(array $data): void
    {
        $this->myChatMember = ChatMemberUpdated::init($data);
    }

    private function setChatMember(array $data): void
    {
        $this->chatMember = ChatMemberUpdated::init($data);
    }

    private function setChatJoinRequest(array $data): void
    {
        $this->chatJoinRequest = ChatJoinRequest::init($data);
    }
}
