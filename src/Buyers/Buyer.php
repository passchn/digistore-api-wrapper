<?php

namespace DigistoreApi\Buyers;

use DigistoreApi\Entity;

class Buyer extends Entity
{
    public \stdClass $api_data;
    public string $id;
    public string $type;
    public string $first_name;
    public string $last_name;
    public string $email;

    public function __construct(\stdClass $data)
    {
        $this->api_data = $data;
        $this->id = $data->id;
        $this->type = $data->buyer_type;
        $this->first_name = $data->first_name;
        $this->last_name = $data->last_name;
        $this->email = $data->email;
    }
}