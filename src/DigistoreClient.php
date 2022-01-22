<?php

namespace DigistoreApi;

use DigistoreApi\Digistore\DigistoreApi;
use DigistoreApi\Digistore\DigistoreApiException;
use Nette\Utils\Arrays;

class DigistoreClient
{
    private DigistoreApi $api;
    private array $errors = [];

    public function __construct(string $api_key)
    {
        $this->api = DigistoreApi::connect($api_key);
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
