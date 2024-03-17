<?php

namespace App\Http\Controllers;

use App\Contracts\Order\OrderCreate;
use App\Contracts\Order\OrderDelete;
use App\Exceptions\UnableToDeleteException;
use App\Helpers\UserHelper;
use App\Http\DTO\OrderDTO;
use App\Http\Resources\Order\OrderCollection;
use App\Http\Resources\Order\OrderResource;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function index(): OrderCollection
    {
        return OrderCollection::make(UserHelper::getOrders());
    }

    public function store(OrderCreate $orderCreate): OrderResource
    {
        $user = UserHelper::getAuthUser();

        return OrderResource::make(
            $orderCreate(
                new OrderDTO(
                    $user->id,
                    $user->cart->id,
                    $user->cart->total_price
                )
            ));
    }

    /**
     * @throws UnableToDeleteException
     */
    public function destroy(OrderDelete $orderDelete, int $id): JsonResponse
    {
        $user = UserHelper::getAuthUser();

        $order = new OrderDTO(
            $user->id,
            $user->cart->id,
            $user->cart->total_price
        );

        $order->setId($id);

        if (!$orderDelete($order)) {
            throw new UnableToDeleteException();
        }

        return response()->json(['message' => 'Order deleted']);
    }
}
