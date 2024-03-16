<?php

namespace App\Http\Controllers;

use App\Actions\Order\OrderCreateAction;
use App\Actions\Order\OrderDeleteAction;
use App\Exceptions\UnableToDeleteException;
use App\Helpers\UserHelper;
use App\Http\Resources\Order\OrderCollection;
use App\Http\Resources\Order\OrderResource;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function index(): OrderCollection
    {
        return OrderCollection::make(UserHelper::getAuthUser()->orders);
    }

    public function store(OrderCreateAction $orderCreateAction): OrderResource
    {
        return OrderResource::make($orderCreateAction(UserHelper::getAuthUser()));
    }

    //Для расширения, рассмотрел бы вариант со статусами, чтобы восстановить заказ. Можно и soft delete.

    /**
     * @throws UnableToDeleteException
     */
    public function destroy(OrderDeleteAction $orderDeleteAction, int $id): JsonResponse
    {
        if (!$orderDeleteAction(UserHelper::getAuthUser(), $id)) {
            throw new UnableToDeleteException();
        }

        return response()->json(['message' => 'Order deleted']);
    }
}
