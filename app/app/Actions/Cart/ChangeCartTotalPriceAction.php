<?php

namespace App\Actions\Cart;

use App\Exceptions\UnableToUpdateException;
use App\Models\Cart;
use Exception;

class ChangeCartTotalPriceAction
{

    /**
     * @throws UnableToUpdateException
     */
    public function __invoke(Cart $cart, float $sum, $add = true): bool
    {
        try {
            $add ? $cart->total_price += $sum : $cart->total_price -= $sum;
            if (!$cart->save()) throw new Exception();
        } catch (Exception) {
            throw new UnableToUpdateException();
        }

        return true;
    }

}
