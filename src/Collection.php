<?php

namespace DigistoreApi;

use DigistoreApi\Purchases\Purchase;
use Nette\Utils\Arrays;

class Collection
{
    protected DigistoreClient $client;

    public function __construct(DigistoreClient $client)
    {
        $this->client = $client;
    }

    protected function findEntity(string $action, string $id)
    {
        $response = $this->client->call($action, $id);

        if (!$response) {
            return null;
        }

        return $response;
    }

    protected function findManyEntities(string $action, array $ids)
    {
        if (!Arrays::isList($ids)) {
            throw new \Exception("\$purchase_ids must be a list, i.e., an array without keys. ");
        }

        $ids = implode(',', $ids);
        $response = $this->client->call($action, $ids);

        if (!$response) {
            return null;
        }

        if (!is_array($response)) {
            $response = [$response];
        }

        return $response;
    }
}