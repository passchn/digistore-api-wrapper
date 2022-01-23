<?php

namespace DigistoreApi\Deliveries;

use DigistoreApi\Collection;

class DeliveryCollection extends Collection
{
    const LIST = "listDeliveries";

    public function list(?array $options=null)
    {
        $response = $this->listEntities(self::LIST, $options);
        return $response;
    }
}