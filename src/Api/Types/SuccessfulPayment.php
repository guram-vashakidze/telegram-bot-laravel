<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Exceptions\TelegramCurrencyEmptyException;

/**
 * Class SuccessfulPayment
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object contains basic information about a successful payment
 *
 * @link https://core.telegram.org/bots/api#successfulpayment
 *
 * @property-read string $currency Three-letter ISO 4217 currency code
 * @property-read int $totalAmount Total price in the smallest units of the currency (integer, not float/double)
 * @property-read string $invoicePayload Bot specified invoice payload
 * @property-read string|null $shippingOptionId Identifier of the shipping option chosen by the user
 * @property-read OrderInfo|null $orderInfo Order info provided by the user
 * @property-read string $telegramPaymentChargeId Telegram payment identifier
 * @property-read string $providerPaymentChargeId Provider payment identifier
 */
class SuccessfulPayment extends Type
{
    protected string $currency;
    protected int $totalAmount;
    protected string $invoicePayload;
    protected ?string $shippingOptionId;
    protected ?OrderInfo $orderInfo;
    protected string $telegramPaymentChargeId;
    protected string $providerPaymentChargeId;

    public static function init(array $data): self
    {
        $payment = new self();

        $payment->currency = $data['currency'];
        $payment->totalAmount = $data['total_amount'];
        $payment->invoicePayload = $data['invoice_payload'];
        $payment->shippingOptionId = $data['shipping_option_id'] ?? null;
        $payment->orderInfo = !empty($data['order_info']) ? OrderInfo::init($data['order_info']) : null;
        $payment->telegramPaymentChargeId = $data['telegram_payment_charge_id'];
        $payment->providerPaymentChargeId = $data['provider_payment_charge_id'];

        return $payment;
    }

    /**
     * @return float
     * @throws TelegramCurrencyEmptyException
     */
    public function getRealTotalAmount(): float
    {
        $currencies = @file_get_contents('currency.json');

        if (empty($currencies)) {
            throw new TelegramCurrencyEmptyException();
        }

        $currencies = json_decode($currencies, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new TelegramCurrencyEmptyException();
        }

        if (!array_key_exists($this->currency, $currencies)) {
            throw new TelegramCurrencyEmptyException();
        }

        $exp = $currencies[$this->currency]['exp'];

        return (float)$this->totalAmount/$exp;
    }
}
