<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Order $order): Response
    {
        return $user->id === $order->user_id
            ? $this->allow()
            : $this->denyAsNotFound();
    }
}
