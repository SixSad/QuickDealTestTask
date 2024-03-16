<?php

namespace App\Actions\Order;

use App\Actions\Balance\ChangeBalanceAction;
use App\Models\Order;
use App\Models\User;
use Throwable;

class OrderCreateAction
{

    public function __construct(
        private readonly ChangeBalanceAction $changeBalanceAction
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(User $user): Order
    {
        $userCart = $user->cart;

        throw_if(
            $userCart->total_price <= 0,
            new \Exception('Cart is empty', 405)
        );

        throw_if(
            $user->balance->balance < $userCart->total_price,
            new \Exception('Not enough balance', 405)
        );

        /** @var Order $order */
        $order = Order::query()
            ->create([
                'user_id' => $user->id,
                'cart_id' => $userCart->id,
                'total_price' => $userCart->total_price
            ]);

        ($this->changeBalanceAction)($user->id, $userCart->total_price, false);

        return $order;
    }

}
