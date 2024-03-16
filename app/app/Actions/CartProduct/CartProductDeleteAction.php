<?php

namespace App\Actions\CartProduct;

use App\Actions\Cart\ChangeCartTotalPriceAction;
use App\Exceptions\UnableToCreateException;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\User;

class CartProductDeleteAction
{

    public function __construct(
        private readonly ChangeCartTotalPriceAction $changeCartTotalPriceAction
    )
    {
    }

    public function __invoke(User $user, int $productId): bool
    {
        try {
            /** @var CartProduct $cartProduct */
            $cartProduct = CartProduct::query()->where('product_id', $productId)->firstOrFail();

            if (!($this->changeCartTotalPriceAction)(
                Cart::query()->findOrFail($cartProduct->cart_id)->getAttribute('id'),
                Product::query()->findOrFail($cartProduct->product_id)->getAttribute('price'),
                false
            )) {
                throw new UnableToCreateException();
            }

            $cartProduct->delete();
        } catch (\Exception) {
            return false;
        }

        return true;
    }

}
