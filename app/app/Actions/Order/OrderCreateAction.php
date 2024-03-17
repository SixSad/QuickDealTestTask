<?php

namespace App\Actions\Order;

use App\Actions\Balance\ChangeBalanceAction;
use App\Contracts\Order\OrderCreate;
use App\Exceptions\UnableToCreateException;
use App\Http\DTO\OrderDTO;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Exception;

readonly class OrderCreateAction implements OrderCreate
{

    public function __construct(
        private ChangeBalanceAction $changeBalanceAction
    )
    {
    }

    /**
     * @throws UnableToCreateException
     */
    public function __invoke(OrderDTO $orderDTO): Order
    {
        try {
            /** @var Cart $userCart */
            $userCart = Cart::query()->findOrFail($orderDTO->cartId);

            /** @var User $user */
            $user = User::query()->findOrFail($orderDTO->userId);

            if (
                $userCart->total_price <= 0
                || $user->balance->balance < $userCart->total_price
            ) {
                throw new Exception();

            }

            /** @var Order $order */
            $order = Order::query()
                ->create([
                    'user_id' => $user->id,
                    'cart_id' => $userCart->id,
                    'total_price' => $userCart->total_price
                ]);

            ($this->changeBalanceAction)($user->balance, $userCart->total_price, false);

            return $order;
        } catch (Exception) {
            throw new UnableToCreateException();
        }
    }

}
