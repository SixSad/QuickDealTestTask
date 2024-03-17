<?php

namespace App\Actions\CartProduct;

use App\Actions\Cart\ChangeCartTotalPriceAction;
use App\Contracts\CartProduct\CartProductDelete;
use App\Exceptions\UnableToDeleteException;
use App\Http\DTO\CartProductDTO;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Exception;

readonly class CartProductDeleteAction implements CartProductDelete
{

    public function __construct(
        private ChangeCartTotalPriceAction $changeCartTotalPriceAction
    )
    {
    }

    /**
     * @throws UnableToDeleteException
     */
    public function __invoke(CartProductDTO $cartProductDTO): bool
    {
        try {
            /** @var CartProduct $cartProduct */
            $cartProduct = CartProduct::query()
                ->where('product_id', $cartProductDTO->product_id)
                ->firstOrFail();

            /** @var Cart $cart */
            $cart = Cart::query()->findOrFail($cartProduct->cart_id);

            /** @var Product $product */
            $productPrice = Product::query()
                ->findOrFail($cartProduct->product_id)
                ->getAttribute('price');

            if (!($this->changeCartTotalPriceAction)(
                $cart,
                $productPrice,
                false
            )) {
                throw new Exception();
            }

            if (!$cartProduct->delete()) throw new Exception();
        } catch (Exception) {
            throw new UnableToDeleteException();
        }

        return true;
    }

}
