<?php

namespace DigistoreApi\Purchases;

use DigistoreApi\Collection;
use Nette\Utils\Arrays;

class PurchasesCollection extends Collection
{
    const GET_PURCHASE = "getPurchase";

    public function find(string $purchase_id)
    {
        $response = $this->client->call(self::GET_PURCHASE, $purchase_id);

        if (!$response) {
            return null;
        }

        return $response;
    }

    public function findMany(array $purchase_ids)
    {
        if (!Arrays::isList($purchase_ids)) {
            throw new \Exception("\$purchase_ids must be a list, i.e., an array without keys. ");
        }

        $purchase_ids = implode(',', $purchase_ids);
        $response = $this->client->call(self::GET_PURCHASE, $purchase_ids);

        if (!$response) {
            return null;
        }

        return $response;
    }
}