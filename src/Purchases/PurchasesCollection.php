<?php

namespace DigistoreApi\Purchases;

use DigistoreApi\Collection;

class PurchasesCollection extends Collection
{
    const GET = "getPurchase";
    const LIST = "listPurchases";

    /**
     * Find a single Purchase by order id / purchase id.
     */
    public function get(string $id): ?Purchase
    {
        $response = $this->getEntity(self::GET, $id);

        if (!$response) {
            return null;
        }

        return new Purchase($response);
    }

    /**
     * Pass a list of purchase_ids to get multiple Purchases.
     */
    public function getMany(array $ids): ?array
    {
        $response = $this->getManyEntities(self::GET, $ids);
        if (!$response) {

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