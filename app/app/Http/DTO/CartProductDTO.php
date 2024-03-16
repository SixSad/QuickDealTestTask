<?php

namespace App\Http\DTO;

readonly class CartProductDTO
{
    public function __construct(
        public ?int    $cart_id = null,
        public ?int $product_id = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'cart_id' => $this?->cart_id,
            'product_id' => $this?->product_id,
        ];
    }
}
