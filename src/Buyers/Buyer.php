<?php

namespace DigistoreApi\Buyers;

use DigistoreApi\Entity;
use Nette\Utils\DateTime;

class Buyer extends Entity
{
    public \stdClass $api_data;
    public ?string $id;
    public ?string $type;

    public ? string $salutation;
    public ? string $title;
    public ?string $first_name;
    public ?string $last_name;
    public ?DateTime $created_at;

    public ? string $company;
    public ?string $email;
    public ?string $phone;

    public ? string $street_name;
    public ? string $street_number;
    public ? string $street2;
    public ? string $zipcode;
    public ? string $city;
    public ? string $country;
    public ? string $state;

    public function __construct(\stdClass $data)
    {
        $this->api_data = $data ?? null;
        $this->id = $data->id ?? null;
        $this->type = $data->buyer_type ?? null;

        $this->salutation = $data->salutation ?? null;
        $this->title = $data->title ?? null;
        $this->first_name = $data->first_name ?? null;
        $this->last_name = $data->last_name ?? null;
        $this->created_at = $data->created_at ? DateTime::from($data->created_at) : null;

        $this->company = $data->company ?? null;
        $this->email = $data->email ?? null;
        $this->phone = $data->phone ?? null;

        $this->street_name = $data->street_name ?? null;
        $this->street_number = $data->street_number ?? null;
        $this->street2 = $data->street2 ?? null;
        $this->zipcode = $data->zipcode ?? null;
        $this->city = $data->city ?? null;
        $this->country = $data->country ?? null;
        $this->state = $data->state ?? null;
    }
}
