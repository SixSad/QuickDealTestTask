<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelper;
use App\Http\Resources\Cart\CartResource;

class CartController extends Controller
{
    public function index(): CartResource
    {
        return CartResource::make(UserHelper::getCart());
    }

}
