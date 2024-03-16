<?php

namespace App\Actions\CartProduct;

use App\Actions\Cart\ChangeCartTotalPriceAction;
use App\Http\DTO\CartProductDTO;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\User;
use Exception;

class CartProductCreateAction
{
    public function __construct(
        private readonly ChangeCartTotalPriceAction $changeCartTotalPriceAction
    )
    {
    }

    public function __invoke(User $user, CartProductDTO $cartProductDTO): CartProduct|null
    {
        try {
            /** @var CartProduct $cartProduct */
            $cartProduct = CartProduct::query()->create([
                'cart_id' => $cartProductDTO->cart_id,
                'product_id' => $cartProductDTO->product_id,
            ]);

            ($this->changeCartTotalPriceAction)(
                $cartProduct->cart_id,
                Product::query()->findOrFail($cartProductDTO->product_id)->getAttribute('price')
            );

            return $cartProduct;
        } catch (Exception) {
            return null;
        }
    }

}
