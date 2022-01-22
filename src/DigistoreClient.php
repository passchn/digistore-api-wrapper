<?php

namespace DigistoreApi;

use DigistoreApi\Digistore\DigistoreApi;
use DigistoreApi\Digistore\DigistoreApiException;
use DigistoreApi\Purchases\PurchasesCollection;
use Nette\Utils\Arrays;

class DigistoreClient
{
    private DigistoreApi $api;
    private array $errors = [];

    public PurchasesCollection $Purchases;

    public function __construct(string $api_key)
    {
        $this->api = DigistoreApi::connect($api_key);
        $this->Purchases = new PurchasesCollection($this);
    }

    public function call(string $method, $arguments)
    {
        try {
            $response = $this->api->$method($arguments);
        } catch (DigistoreApiException $e) {
            $this->errors[] = $e;
            return false;
        }

        return $response;
    }

    public function isConnected()
    {
        try {
            $this->api->ping();
        } catch (DigistoreApiException $e) {
            $this->errors[] = $e;

            return false;
        }

        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getLastError(): ?string
    {
        /**
         * @var \Exception|null $exception
         */
        $exception = Arrays::last($this->errors);

        return $exception ? $exception->getMessage() : null;
    }
}
