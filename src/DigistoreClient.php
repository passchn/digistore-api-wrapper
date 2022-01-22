<?php

namespace DigistoreApi;

use DigistoreApi\Digistore\DigistoreApi;

class DigistoreClient
{
    private DigistoreApi $api;

    public function __construct(string $api_key)
    {
        $this->api = DigistoreApi::connect($api_key);
    }

    public function isConnected()
    {
        $this->api->ping();
    }
}