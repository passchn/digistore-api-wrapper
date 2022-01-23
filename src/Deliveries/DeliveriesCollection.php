<?php

namespace DigistoreApi\Deliveries;

use DigistoreApi\Collection;
use Nette\Utils\DateTime;

class DeliveriesCollection extends Collection
{
    const LIST = "listDeliveries";

    public function list(?array $options = null, ?array $config = null): ?array
    {
        $response = $this->listEntities(self::LIST, $options);
        if (!$response || empty($response->delivery)) {
            return null;
        }

        $deliveries = [];
        foreach ($response->delivery as $data) {

            $delivery = new Delivery($data);
            if (empty($config['skip_purchases'])) {
                $delivery->purchase = $this->client->Purchases->get($delivery->purchase_id);
            }

            $deliveries[] = $delivery;
        }

        return $deliveries;
    }

    public function listForPurchase(string $purchase_id): ?array
    {
        return $this->list(['purchase_id' => $purchase_id]);
    }

    /**
     * List Deliveries for a time range, defaults to the last 6 weeks.
     */
    public function listForTimeRange(string $start = "-6 weeks", string $end = "now"): ?array
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
     * List Deliveries by Type, defaults to the last 6 weeks.
     * e.g.: listByTypes(DeliveryTypes::REQUEST, DeliveryType::IN_PROGRESS)
     */
    public function listByTypes(array $types, string $start_date = "-6 weeks"): ?array
    {
        foreach ($types as $type) {
            if (!in_array($type, DeliveryTypes::getList())) {

                throw new \Exception("Invalid DeliveryType: $type. ");
            }
        }

        $date_from = DateTime::from($start_date);

        return $this->list([
            'from' => $date_from->format("Y-m-d"),
            'to' => "now",
            'type' => implode(',', $types),
        ]);
    }

    /**
     * Deliveries that are not yet processed
     */
    public function listOpen(?array $config = null): ?array
    {
        return $this->list(['is_processed' => false], $config);
    }

    /**
     * Returns the number of unprocessed Deliveries,
     * or null on failure.
     */
    public function countOpen(): ?int
    {
        $open = $this->listOpen([
            'skip_purchases' => true,
        ]);

        return is_array($open) ? count($open) : null;
    }
}
