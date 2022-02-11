<?php

namespace DigistoreApi\Purchases;

use DigistoreApi\Buyers\Buyer;
use DigistoreApi\Entity;
use DigistoreApi\Transactions\Transaction;
use Nette\Utils\DateTime;

/**
 * @link https://dev.digistore24.com/en/articles/51-getpurchase
 */
class Purchase extends Entity
{
    public \stdClass $api_data;

    public ?string $id;
    public ?float $amount;
    public ?string $currency;
    public ?string $vat_country;
    public ?float $merchant_amount;
    public ?float $affiliate_amount;
    public ?float $vat_amount;
    public ?float $vat_rate;
    public ?DateTime $created_at;

    public ?string $voucher_code;

    public ?string $delivery_types;
    public ?string $delivery_types_msg;
    public ?string $billing_type;
    public ?string $billing_type_msg;
    public ?string $billing_mode;
    public ?string $billing_mode_msg;
    public ?string $billing_status;
    public ?string $billing_status_msg;
    public ?string $payment_plan_msg;

    public ?string $renew_url;
    public ?string $receipt_url;
    public ?string $invoice_url;
    public ?string $details_url;

    public ?Buyer $buyer;
    public ?array $transactions;

    public function __construct(\stdClass $data)
    {
        $this->api_data = $data;

        $this->id = $data->id ?? null;
        $this->amount = (float)$data->amount ?? null;
        $this->currency = $data->currency ?? null;
        $this->vat_country = $data->vat_country ?? null;
        $this->merchant_amount = (float)$data->merchant_amount ?? null;
        $this->affiliate_amount = (float)$data->affiliate_amount ?? null;
        $this->vat_amount = (float)$data->vat_amount ?? null;
        $this->vat_rate = (float)$data->vat_rate ?? null;
        $this->created_at = $data->created_at ? DateTime::from($data->created_at) : null;

        $this->voucher_code = $data->voucher_code ?? null;

        $this->delivery_types = $data->delivery_types;
        $this->delivery_types_msg = $data->delivery_types_msg;
        $this->billing_type = $data->billing_type;
        $this->billing_type_msg = $data->billing_type_msg;
        $this->billing_mode = $data->billing_mode;
        $this->billing_mode_msg = $data->billing_mode_msg;
        $this->billing_status = $data->billing_status;
        $this->billing_status_msg = $data->billing_status_msg;
        $this->payment_plan_msg = $data->payment_plan_msg;

        $this->renew_url = $data->renew_url ?? null;
        $this->receipt_url = $data->receipt_url ?? null;
        $this->invoice_url = $data->invoice_url ?? null;
        $this->details_url = $data->details_url ?? null;

        $this->buyer = new Buyer($data->buyer);

        $this->transactions = array_map(
            function ($transaction_data) {
                return new Transaction($transaction_data);
            },
            $data->last_payment
        );
    }
}