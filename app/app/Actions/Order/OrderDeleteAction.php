<?php

namespace App\Actions\Order;

use App\Actions\Balance\ChangeBalanceAction;
use App\Contracts\Order\OrderDelete;
use App\Exceptions\UnableToDeleteException;
use App\Http\DTO\OrderDTO;
use App\Models\Order;
use App\Models\User;
use Exception;

readonly class OrderDeleteAction implements OrderDelete
{

    public function __construct(
        private ChangeBalanceAction $changeBalanceAction
    )
    {
    }

    /**
     * @throws UnableToDeleteException
     */
    public function __invoke(OrderDTO $orderDTO): bool
    {
        try {
            /** @var Order $order */
            $order = Order::query()->findOrFail($orderDTO->id);

            /** @var User $user */
            $user = User::query()->findOrFail($orderDTO->userId);

            if (!$order->delete()) throw new Exception();

            ($this->changeBalanceAction)($user->balance, $order->total_price, true);
        } catch (Exception) {
            throw new UnableToDeleteException();
        }

        return true;
    }

}
