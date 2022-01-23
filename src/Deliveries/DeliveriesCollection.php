<?php

namespace DigistoreApi\Deliveries;

use DigistoreApi\Collection;

class DeliveriesCollection extends Collection
{
    const LIST = "listDeliveries";

    public function list(?array $options = null): ?array
    {
        $response = $this->listEntities(self::LIST, $options);

        return $response ? $response->delivery : null;
    }

    /**
     * Deliveries that are not yet processed
     */
    public function listOpen(): ?array
    {
        return $this->list(['is_processed' => false]);
    }

    /**
     * Returns the number of unprocessed Deliveries,
     * or null on failure.
     */
    public function countOpen(): ?int
    {
        $open = count($this->listOpen());

        return is_array($open) ? count($open) : null;
    }
}