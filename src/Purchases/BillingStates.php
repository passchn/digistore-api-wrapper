<?php

namespace DigistoreApi\Purchases;

/**
 * @link https://dev.digistore24.com/en/articles/13-events
 */
class BillingStates
{
    const PAYING = "paying";
    const ABORTED = "aborted";
    const UNPAID = "unpaid";
    const REMINDING = "reminding";
    const COMPLETED = "completed";
}