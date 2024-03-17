<?php

namespace App\Actions\CartProduct;

use App\Actions\Cart\ChangeCartTotalPriceAction;
use App\Contracts\CartProduct\CartProductCreate;
use App\Exceptions\UnableToCreateException;
use App\Http\DTO\CartProductDTO;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Exception;

readonly class CartProductCreateAction implements CartProductCreate
{
    public function __construct(
        private ChangeCartTotalPriceAction $changeCartTotalPriceAction
    )
    {
    }

    /**
     * @throws UnableToCreateException
     */
    public function __invoke(CartProductDTO $cartProductDTO): CartProduct
    {
        try {
            /** @var Cart $cart */
            $cart = Cart::query()->findOrFail($cartProductDTO->cart_id);

            /** @var CartProduct $cartProduct */
            $cartProduct = CartProduct::query()->create([
                'cart_id' => $cartProductDTO->cart_id,
                'product_id' => $cartProductDTO->product_id,
            ]);

            ($this->changeCartTotalPriceAction)(
                $cart,
                Product::query()->findOrFail($cartProductDTO->product_id)->getAttribute('price')
            );

            return $cartProduct;
        } catch (Exception) {
            throw new UnableToCreateException();
        }
    }

}
