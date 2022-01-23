<?php

namespace DigistoreApi;

use Nette\Utils\Arrays;

abstract class Collection
{
    protected DigistoreClient $client;

    public function __construct(DigistoreClient $client)
    {
        $this->client = $client;
    }

    protected function getEntity(string $action, string $id)
    {
        return $this->client->call($action, $id);
    }

    protected function getManyEntities(string $action, array $ids)
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

    protected function listEntities(string $action, ?array $arguments=null)
    {
        return $this->client->call($action, $arguments);
    }
}