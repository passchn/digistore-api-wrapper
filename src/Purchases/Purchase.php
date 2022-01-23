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

    public string $id;
    public float $amount;
    public string $currency;
    public string $vat_country;
    public float $merchant_amount;
    public float $affiliate_amount;
    public float $vat_amount;
    public float $vat_rate;
    public DateTime $created_at;

    public string $renew_url;
    public string $receipt_url;
    public string $invoice_url;

    public Buyer $buyer;

    public function __construct(\stdClass $data)
    {
        $this->api_data = $data;

        $this->id = $data->id;
        $this->amount = (float)$data->amount;
        $this->currency = $data->currency;
        $this->vat_country = $data->vat_country;
        $this->merchant_amount = (float)$data->merchant_amount;
        $this->affiliate_amount = (float)$data->affiliate_amount;
        $this->vat_amount = (float)$data->vat_amount;
        $this->vat_rate = (float)$data->vat_rate;
        $this->created_at = DateTime::from($data->created_at);

        $this->renew_url = $data->renew_url;
        $this->receipt_url = $data->receipt_url;
        $this->invoice_url = $data->invoice_url;

        $this->buyer = new Buyer($data->buyer);
    }
}