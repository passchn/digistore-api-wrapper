<?php

namespace DigistoreApi\Purchases;

use DigistoreApi\Buyers\Buyer;
use DigistoreApi\Entity;
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

    public ?string $renew_url;
    public ?string $receipt_url;
    public ?string $invoice_url;

    public ?Buyer $buyer;

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

        $this->renew_url = $data->renew_url ?? null;
        $this->receipt_url = $data->receipt_url ?? null;
        $this->invoice_url = $data->invoice_url ?? null;

        $this->buyer = new Buyer($data->buyer);
    }
}