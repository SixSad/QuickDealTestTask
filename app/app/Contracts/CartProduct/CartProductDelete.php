<?php

namespace App\Contracts\CartProduct;

use App\Http\DTO\CartProductDTO;

interface CartProductDelete
{
    public function __invoke(CartProductDTO $cartProductDTO): bool;
}
