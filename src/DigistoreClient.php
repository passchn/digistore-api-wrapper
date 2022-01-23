<?php

namespace DigistoreApi;

use DigistoreApi\Buyers\BuyersCollection;
use DigistoreApi\Deliveries\DeliveriesCollection;
use DigistoreApi\Digistore\DigistoreApi;
use DigistoreApi\Digistore\DigistoreApiException;
use DigistoreApi\Purchases\PurchasesCollection;
use Nette\Utils\Arrays;

class DigistoreClient
{
    private DigistoreApi $api;
    private array $errors = [];

    public PurchasesCollection $Purchases;
    public BuyersCollection $Buyers;
    public DeliveriesCollection $Deliveries;

    public function __construct(string $api_key)
    {
        $this->api = DigistoreApi::connect($api_key);
        $this->Purchases = new PurchasesCollection($this);
        $this->Buyers = new BuyersCollection($this);
        $this->Deliveries = new DeliveriesCollection($this);
    }

    public function isConnected(): bool
    {
        try {
            $this->api->ping();
        } catch (DigistoreApiException $e) {
            $this->errors[] = $e;

            return false;
        }

        return true;
    }

    public function whoAmI(): ?\stdClass
    {
        return $this->call("getUserInfo");
    }

    public function call(string $method, ...$arguments)
    {
        try {
            $response = $this->api->$method(...$arguments);
        } catch (DigistoreApiException $e) {
            $this->errors[] = $e;
            return null;
        }

        return $response;
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

    public function registerError(\Exception $e)
    {
        $this->errors[] = $e;
    }
}
