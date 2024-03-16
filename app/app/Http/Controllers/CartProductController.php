<?php

namespace App\Http\Controllers;

use App\Actions\CartProduct\CartProductCreateAction;
use App\Actions\CartProduct\CartProductDeleteAction;
use App\Exceptions\UnableToCreateException;
use App\Exceptions\UnableToDeleteException;
use App\Helpers\UserHelper;
use App\Http\DTO\CartProductDTO;
use App\Http\Requests\StoreCartProductRequest;
use App\Http\Resources\CartProduct\CartProductResource;
use Illuminate\Http\JsonResponse;

class CartProductController extends Controller
{

    /**
     * @throws UnableToCreateException
     */
    public function store(StoreCartProductRequest $request, CartProductCreateAction $cartProductCreateAction): CartProductResource
    {
        $cartProduct = $cartProductCreateAction(
            UserHelper::getAuthUser(),
            new CartProductDTO(
                UserHelper::getCart()->id,
                $request->get('product_id'))
        );

        if (!$cartProduct) {
            throw new UnableToCreateException();
        }

        return CartProductResource::make($cartProduct);
    }

    /**
     * @throws UnableToDeleteException
     */
    public function destroy(StoreCartProductRequest $request, CartProductDeleteAction $cartProductDeleteAction): JsonResponse
    {
        if (!$cartProductDeleteAction(UserHelper::getAuthUser(), $request->get('product_id'))) {
            throw new UnableToDeleteException();
        }

        return response()->json(['message' => 'Product deleted from cart']);
    }
}
