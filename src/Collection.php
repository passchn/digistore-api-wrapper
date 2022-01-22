<?php

namespace DigistoreApi;

class Collection
{
    protected DigistoreClient $client;

    public function __construct(DigistoreClient $client)
    {
        $this->client = $client;
    }
}