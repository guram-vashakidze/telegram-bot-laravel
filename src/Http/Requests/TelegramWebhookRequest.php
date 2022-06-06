<?php

namespace Vashakidze\Telegram\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Vashakidze\Telegram\Api\Enums\WebhookUpdateType;
use Vashakidze\Telegram\Api\Types\Update;
use Vashakidze\Telegram\Http\Requests\Traits\CallBackQueryRules;
use Vashakidze\Telegram\Http\Requests\Traits\ChatJoinRequestRules;
use Vashakidze\Telegram\Http\Requests\Traits\ChatMemberUpdatedRules;
use Vashakidze\Telegram\Http\Requests\Traits\ChosenInlineResultRules;
use Vashakidze\Telegram\Http\Requests\Traits\InlineQueryRules;
use Vashakidze\Telegram\Http\Requests\Traits\MessageRules;
use Vashakidze\Telegram\Http\Requests\Traits\PollAnswerRules;
use Vashakidze\Telegram\Http\Requests\Traits\PollRules;
use Vashakidze\Telegram\Http\Requests\Traits\PreCheckoutQueryRules;
use Vashakidze\Telegram\Http\Requests\Traits\ShippingQueryRules;

class TelegramWebhookRequest extends FormRequest
{
    use MessageRules;
    use CallBackQueryRules;
    use InlineQueryRules;
    use ChosenInlineResultRules;
    use ShippingQueryRules;
    use PreCheckoutQueryRules;
    use PollRules;
    use PollAnswerRules;
    use ChatMemberUpdatedRules;
    use ChatJoinRequestRules;

    private array $rules = [];

    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $keys = array_keys($this->request->all());

        $allowedUpdates = config('telegram.webhook.setting.allowed_updates');

        foreach ($allowedUpdates as $allowedUpdate) {
            if (!in_array($allowedUpdate, $keys)) {
                continue;
            }

            $type = WebhookUpdateType::fromValue($allowedUpdate);

            $this->rules = match ($allowedUpdate) {
                WebhookUpdateType::message,
                WebhookUpdateType::edited_message,
                WebhookUpdateType::channel_post,
                WebhookUpdateType::edited_channel_post => $this->getMessageRules($type->value),
                WebhookUpdateType::callback_query => $this->getCallBackQueryRules($type->value),
                WebhookUpdateType::inline_query => $this->getInlineQueryRules($type->value),
                WebhookUpdateType::chosen_inline_result => $this->getChosenInlineResultRules($type->value),
                WebhookUpdateType::shipping_query => $this->getShippingQueryRules($type->value),
                WebhookUpdateType::pre_checkout_query => $this->getPreCheckoutQueryRules($type->value),
                WebhookUpdateType::poll => $this->getPollRules($type->value),
                WebhookUpdateType::poll_answer => $this->getPollAnswerRules($type->value),
                WebhookUpdateType::my_chat_member,
                WebhookUpdateType::chat_member => $this->getChatMemberUpdatedRules($type->value),
                WebhookUpdateType::chat_join_request => $this->getChatJoinRequestRules($type->value),
            };

            break;
        }

        if (empty($type)) {
            return;
        }

        $this->rules = array_merge(
            [
                'update_id' => [
                    'required',
                    'int'
                ],
                $type->value => [
                    'required',
                    'array'
                ]
            ],
            $this->rules
        );
    }

    public function rules(): array
    {
        return $this->rules;
    }

    public function toType(): Update
    {
        return Update::init($this->validated());
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if (!empty($this->validated())) {
                return;
            }
            $this
                ->validator
                ->errors()
                ->add('allowed_update', 'The updated field is not allowed in this Telegram Bot');
        });
    }
}
