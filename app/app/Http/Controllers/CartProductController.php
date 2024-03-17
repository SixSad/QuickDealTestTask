<?php

namespace App\Http\Controllers;

use App\Contracts\CartProduct\CartProductCreate;
use App\Contracts\CartProduct\CartProductDelete;
use App\Helpers\UserHelper;
use App\Http\DTO\CartProductDTO;
use App\Http\Requests\StoreCartProductRequest;
use App\Http\Resources\CartProduct\CartProductResource;
use Illuminate\Http\JsonResponse;

class CartProductController extends Controller
{
    public function store(StoreCartProductRequest $request, CartProductCreate $cartProductCreate): CartProductResource
    {
        $cartProduct = $cartProductCreate(
            new CartProductDTO(
                UserHelper::getCart()->id,
                $request->get('product_id'))
        );

        return CartProductResource::make($cartProduct);
    }

    public function destroy(StoreCartProductRequest $request, CartProductDelete $cartProductDelete): JsonResponse
    {
        $cartProduct = new CartProductDTO(
            UserHelper::getCart()->id,
            $request->get('product_id')
        );

        $cartProductDelete($cartProduct);

        return response()->json(['message' => 'Product deleted from cart']);
    }
}
