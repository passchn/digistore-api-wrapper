<?php

namespace DigistoreApi\Deliveries;

/**
 * request - the order has not been processed. The items are to be sent.
 * in_progress - one of your delivery handling agents is currently dealing with the delivery.
 * delivery - all items of the delivery have been sent
 * partial_delivery - some items of the delivery have been sent
 * return - the package has been returned - maybe the shipping address was wrong
 * cancel - the delivery has been canceled - maybe because of a refund of the purchase
 *
 * @link https://dev.digistore24.com/en/articles/70-listdeliveries
 */
class DeliveryTypes
{
    const REQUEST = "request";
    const IN_PROGRESS = "in_progress";
    const DELIVERY = "delivery";
    const PARTIAL_DELIVERY = "partial_delivery";
    const RETURN = "return";
    const CANCEL = "cancel";

    public static function getList(): array
    {
        $me = new \ReflectionClass(self::class);
        return $me->getConstants();
    }
}