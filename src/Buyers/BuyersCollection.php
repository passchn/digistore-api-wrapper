<?php

namespace DigistoreApi\Buyers;

use DigistoreApi\Collection;
use DigistoreApi\Purchases\PurchasesCollection;
use Nette\Utils\DateTime;

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

    public function findByEmail(string $email, string $date_from='-1 year'): ?Buyer
    {
        try {
            $date = DateTime::from($date_from);
            $purchases = $this->client->call(PurchasesCollection::LIST, $date->format('Y-m-d H:i:s'), 'now', ['email' => $email]);
            $buyer = new Buyer(current($purchases->purchase_list)->buyer);
        } catch (\Exception $e) {
            $this->client->registerError($e);
            return null;
        }

        return $buyer;
    }
}