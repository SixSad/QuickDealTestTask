<?php

namespace App\Helpers;

use App\Models\Balance;
use App\Models\Cart;
use App\Models\User;

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
        return static::getAuthUser()->id;
    }

    public static function getBalance(): Balance
    {
        return static::getAuthUser()->balance;
    }

    public static function getCart(): Cart
    {
        return static::getAuthUser()->cart;
    }
}
