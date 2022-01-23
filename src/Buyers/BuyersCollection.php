<?php

namespace DigistoreApi\Buyers;

use DigistoreApi\Collection;
use DigistoreApi\Purchases\Purchase;

class BuyersCollection extends Collection
{
    const GET_BUYER = "getBuyer";

    /**
     * Find a single Purchase by order id / purchase id.
     */
    public function find(string $id): ?Buyer
    {
        $response = $this->findEntity(self::GET_BUYER, $id);

        return $response ? new Buyer($response) : null;
    }

    /**
     * Pass a list of purchase_ids to get multiple Purchases.
     */
    public function findMany(array $ids): ?array
    {
        $response = $this->findManyEntities(self::GET_BUYER, $ids);
        if (!$response) {

            return null;
        }

        return array_map(
            function ($data) {
                return new Buyer($data);
            },
            $response
        );
    }
}