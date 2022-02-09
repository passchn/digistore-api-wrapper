<?php

namespace DigistoreApi\Products;

use DigistoreApi\Collection;

class ProductsCollection extends Collection
{
    const LIST = "listProducts";

    /**
     * @return Product[]
     * @link https://dev.digistore24.com/en/articles/80-listproducts
     */
    public function list(): array
    {
        $response = $this->listEntities(self::LIST);

        return array_map(
            function ($product_data) {
                return new Product($product_data);
            },
            $response->products ?? []
        );
    }
}