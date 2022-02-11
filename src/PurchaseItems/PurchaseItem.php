<?php

namespace DigistoreApi\PurchaseItems;

use DigistoreApi\Entity;

class PurchaseItem extends Entity
{
    public \stdClass $api_data;

    public ?string $id;
    public ?string $product_id;
    public ?string $product_name;
    public ?string $product_name_intern;

    public ?string $delivery_type;
    public ?string $product_type_id;
    public ?string $product_type_name;

    public ?int $quantity;
    public ?int $no;
    public ?int $count;

    public ?bool $product_is_active;
    public ?bool $product_is_deleted;
    public ?float $vat_rate;

    public ?string $url_orderform;
    public ?string $url_product_edit;

    public function __construct(\stdClass $data)
    {
        $this->api_data = $data;

        $this->id = $data->id ?? null;
        $this->product_id = $data->product_id ?? null;
        $this->product_name = $data->product_name ?? null;
        $this->product_name_intern = $data->product_name_intern ?? null;
        $this->delivery_type = $data->delivery_type ?? null;
        $this->product_type_id = $data->product_type_id ?? null;
        $this->product_type_name = $data->product_type_name ?? null;

        $this->quantity = !empty($data->quantity) ? (int)$data->quantity : null;
        $this->no = !empty($data->no) ? (int)$data->no : null;
        $this->count = !empty($data->count) ? (int)$data->count : null;


        $this->product_is_active = !empty($data->product_is_active) ? $data->product_is_active === "Y" : null;
        $this->product_is_deleted = !empty($data->product_is_deleted) ? $data->product_is_deleted === "Y" : null;
        $this->vat_rate = !empty($data->vat_rate) ? (float)$data->vat_rate : null;
        $this->url_orderform = $data->url->orderform ?? null;
        $this->url_product_edit = $data->url->product_edit ?? null;
    }
}