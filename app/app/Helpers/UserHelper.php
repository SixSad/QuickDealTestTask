<?php

namespace App\Helpers;

use App\Models\Balance;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserHelper
{
    public static function getAuthUser(): User
    {
        /** @var User $user */
        $user = auth('sanctum')->user();

        return $user;
    }

    public static function getAuthUserId(): int
    {
        return auth('sanctum')->id();
    }

    public static function getBalance(): Balance
    {
        return static::getAuthUser()->balance;
    }

    public static function getCart(): Cart
    {
        return static::getAuthUser()->cart;
    }

    public static function getOrders(): Order|Collection
    {
        return static::getAuthUser()->orders;
    }
}
