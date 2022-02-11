<?php

namespace DigistoreApi\Transactions;

use DigistoreApi\Entity;
use Nette\Utils\DateTime;

class Transaction extends Entity
{
    public \stdClass $api_data;

    public ?DateTime $date;
    public ?string $pay_method;
    public ?string $type;
    public ?string $id;

    public function __construct(\stdClass $data)
    {
        $this->api_data = $data;

        $this->id = $data->txn_id ?? null;
        $this->pay_method = $data->pay_method ?? null;
        $this->type = $data->txn_type ?? null;
        $this->date = $data->date ? DateTime::from($data->date) : null;
    }
}