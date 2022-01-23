<?php

namespace DigistoreApi\Buyers;

use DigistoreApi\Entity;

class Buyer extends Entity
{
    public \stdClass $api_data;
    public ?string $id;
    public ?string $type;
    public ?string $first_name;
    public ?string $last_name;
    public ?string $email;

    public function __construct(\stdClass $data)
    {
        $this->api_data = $data ?? null;
        $this->id = $data->id ?? null;
        $this->type = $data->buyer_type ?? null;
        $this->first_name = $data->first_name ?? null;
        $this->last_name = $data->last_name ?? null;
        $this->email = $data->email ?? null;
    }
}
