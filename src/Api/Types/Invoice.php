<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Exceptions\TelegramCurrencyEmptyException;

/**
 * Class Invoice
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object contains basic information about an invoice
 *
 * @link https://core.telegram.org/bots/api#invoice
 *
 * @property-read string $title Product name
 * @property-read string $description Product description
 * @property-read string $startParameter Unique bot deep-linking parameter that can be used to generate this invoice
 * @property-read string $currency Three-letter ISO 4217 currency code
 * @property-read int $totalAmount Total price in the smallest units of the currency (integer, not float/double).
 */
class Invoice extends Type
{
    protected string $title;
    protected string $description;
    protected string $startParameter;
    protected string $currency;
    protected int $totalAmount;

    public static function init(array $data): self
    {
        $invoice = new self();

        $invoice->title = $data['title'];
        $invoice->description = $data['description'];
        $invoice->startParameter = $data['start_parameter'];
        $invoice->currency = $data['currency'];
        $invoice->totalAmount = $data['total_amount'];

        return $invoice;
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
