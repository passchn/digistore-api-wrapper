<?php

namespace DigistoreApi\Purchases;

use DigistoreApi\Entity;

/**
 * @link https://dev.digistore24.com/en/articles/51-getpurchase
 */
class Purchase extends Entity
{
    private string $id;
    private float $amount;
}