<?php

namespace DigistoreApi\Purchases;

use DigistoreApi\Collection;
use Nette\Utils\Arrays;

class PurchasesCollection extends Collection
{
    const GET_PURCHASE = "getPurchase";

    /**
     * Find a single Purchase by order id / purchase id.
     */
    public function find(string $id): ?Purchase
    {
        $response = $this->client->call(self::GET_PURCHASE, $id);

        if (!$response) {
            return null;
        }

        return new Purchase($response);
    }

    /**
     * Pass a list of purchase_ids to get multiple Purchases.
     */
    public function findMany(array $ids): ?array
    {
        if (!Arrays::isList($ids)) {
            throw new \Exception("\$purchase_ids must be a list, i.e., an array without keys. ");
        }

        $ids = implode(',', $ids);
        $response = $this->client->call(self::GET_PURCHASE, $ids);

        if (!$response || !is_array($response)) {
            return null;
        }

        return array_map(
            function ($purchase_data) {
                return new Purchase($purchase_data);
            },
            $response
        );
    }
}