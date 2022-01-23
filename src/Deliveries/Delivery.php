<?php

namespace DigistoreApi\Deliveries;

use DigistoreApi\Entity;
use DigistoreApi\Purchases\Purchase;

class Delivery extends Entity
{
    public \stdClass $api_data;
    public ?string $purchase_id;
    public ?Purchase $purchase;

    public function __construct(\stdClass $data)
    {
        $this->api_data = $data;
        $this->purchase_id = $data->purchase_id ?? null;
    }
}