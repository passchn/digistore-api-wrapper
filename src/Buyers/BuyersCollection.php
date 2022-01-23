<?php

namespace DigistoreApi\Buyers;

use DigistoreApi\Collection;
use DigistoreApi\Purchases\PurchasesCollection;
use Nette\Utils\Arrays;
use Nette\Utils\DateTime;
use Nette\Utils\Validators;

class BuyersCollection extends Collection
{
    const GET = "getBuyer";
    const LIST = "listBuyers";

    /**
     * Find a single Buyer by id or email.
     */
    public function get(string $search): ?Buyer
    {
        if (Validators::isEmail($search)) {

            return $this->getByEmail($search);
        }

        $response = $this->getEntity(self::GET, $search);

        return $response ? new Buyer($response->buyer) : null;
    }

    public function getMany(array $terms): ?array
    {
        if (!Arrays::isList($terms)) {
            return null;
        }

        $buyers = [];
        foreach ($terms as $term) {

            $buyer = $this->get($term);
            if ($buyer) {
                $buyers[] = $buyer;
            }
        }

        return count($buyers) ? $buyers : null;
    }

    private function getByEmail(string $email, string $date_from='-5 years'): ?Buyer
    {
        if (!Validators::isEmail($email)) {
            return null;
        }

        try {
            $date = DateTime::from($date_from);
            $purchases = $this->client->call(PurchasesCollection::LIST, $date->format('Y-m-d H:i:s'), 'now', ['email' => $email]);
            $buyer_id = current($purchases->purchase_list)->buyer->id ?? null;

            if ($buyer_id) {
                $buyer = $this->get($buyer_id);
            }

        } catch (\Exception $e) {
            $this->client->registerError($e);
            return null;
        }

        if (empty($buyer) || $buyer->email !== $email) {
            return null;
        }

        return $buyer;
    }
}