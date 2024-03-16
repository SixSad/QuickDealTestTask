<?php

namespace App\Actions\Cart;

use App\Models\Cart;

class ChangeCartTotalPriceAction
{

    public function __invoke(int $cartId, float $sum, $add = true): bool
    {
        try {
            /** @var Cart $cart */
            $cart = Cart::query()->findOrFail($cartId);
            $add ? $cart->total_price += $sum : $cart->total_price -= $sum;
            $cart->save();
        } catch (\Exception) {
            return false;
        }

        return true;
    }

}
