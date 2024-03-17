<?php

namespace App\Http\DTO;

readonly class OrderDTO extends BaseDTO
{
    public function __construct(
        public ?int   $userId = null,
        public ?int   $cartId = null,
        public ?float $totalPrice = null,
    )
    {
    }

}
