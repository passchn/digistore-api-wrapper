<?php

namespace DigistoreApi\Deliveries;

use DigistoreApi\Collection;
use Nette\Utils\DateTime;

class DeliveriesCollection extends Collection
{
    const LIST = "listDeliveries";

    public function list(?array $options = null): ?array
    {
        $response = $this->listEntities(self::LIST, $options);

        return $response ? $response->delivery : null;
    }

    public function listForPurchase(string $purchase_id): ?array
    {
        return $this->list(['purchase_id' => $purchase_id]);
    }

    /**
     * List Deliveries for a time range, defaults to the last 6 weeks.
     */
    public function listForTimeRange(string $start="-6 weeks", string $end="now"): ?array
    {
        try {
            $date_from = DateTime::from($start);
            $date_until = DateTime::from($end);
        } catch (\Exception $e) {
            throw new \Exception("The values for either \$start or \$end are invalid. Error: {$e->getMessage()}.");
        }

        return $this->list([
            'from' => $date_from->format("Y-m-d"),
            'to' => $date_until->format("Y-m-d"),
        ]);
    }

    /**
     * List Deliveries by Type,
     * e.g.: listByTypes(DeliveryTypes::REQUEST, DeliveryType::IN_PROGRESS)
     */
    public function listByTypes(...$types): ?array
    {
        foreach ($types as $type) {
            if (!in_array($type, DeliveryTypes::getList())) {

                throw new \Exception("Invalid DeliveryType: $type. ");
            }
        }

        return $this->list([
            'type' => implode(',', $types),
        ]);
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
        $open = $this->listOpen();

        return is_array($open) ? count($open) : null;
    }
}