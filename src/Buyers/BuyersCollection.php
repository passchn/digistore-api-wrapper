<?php

namespace DigistoreApi\Buyers;

use DigistoreApi\Collection;
use DigistoreApi\Purchases\PurchasesCollection;

class BuyersCollection extends Collection
{
    const GET = "getBuyer";
    const LIST = "listBuyers";

    /**
     * Find a single Purchase by order id / purchase id.
     */
    public function get(string $id): ?Buyer
    {
        $response = $this->getEntity(self::GET, $id);

        return $response ? new Buyer($response->buyer) : null;
    }

    public function findByEmail(string $email): ?Buyer
    {
        $purchases = $this->listEntities(PurchasesCollection::LIST, ['email' => $email]);
        if (!$purchases) {
            return null;
        }

        return $purchases;
    }
}