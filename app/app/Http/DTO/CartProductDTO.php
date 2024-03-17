<?php

namespace App\Http\DTO;

readonly class CartProductDTO extends BaseDTO
{
    public function __construct(
        public ?int    $cart_id = null,
        public ?int $product_id = null,
    )
    {
    }

}
