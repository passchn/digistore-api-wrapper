<?php

namespace DigistoreApi\Products;

use DigistoreApi\Entity;
use Nette\Utils\DateTime;

class Product extends Entity
{
    public \stdClass $api_data;

    public string $id;
    public string $name;
    public bool $is_active;
    public string $description;
    public string $name_intern;
    public string $thankyou_url;
    public string $salespage_url;
    public string $product_group_name;
    public string $product_group_id;
    public DateTime $created_at;
    public DateTime $modified_at;

    public function __construct(\stdClass $data)
    {
        $this->api_data = $data;
        $this->id = $data->id;

        $this->name = $data->name;
        $this->is_active = $data->is_active === "Y";
        $this->name_intern = $data->name_intern;
        $this->thankyou_url = $data->thankyou_url;
        $this->salespage_url = $data->salespage_url;
        $this->product_group_name = $data->product_group_name;
        $this->product_group_id = $data->product_group_id;
        $this->created_at = DateTime::from($data->created_at);
        $this->modified_at = DateTime::from($data->modified_at);
    }
}