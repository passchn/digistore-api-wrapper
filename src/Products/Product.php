<?php

namespace DigistoreApi\Products;

use DigistoreApi\Entity;

class Product extends Entity
{
    public \stdClass $api_data;

    public function __construct(\stdClass $data)
    {
        $this->api_data = $data;
    }
}