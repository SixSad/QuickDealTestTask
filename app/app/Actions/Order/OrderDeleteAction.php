<?php

namespace App\Actions\Order;

use App\Actions\Balance\ChangeBalanceAction;
use App\Models\Order;
use App\Models\User;

class OrderDeleteAction
{

    public function __construct(
        private readonly ChangeBalanceAction $changeBalanceAction
    )
    {
    }

    public function __invoke(User $user, int $orderId): bool
    {
        /** @var Order $order */
        $order = Order::query()->findOrFail($orderId);

        if (!$order->delete()) return false;

        ($this->changeBalanceAction)($user->id, $order->total_price);

        return true;
    }

}
