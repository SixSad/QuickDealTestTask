<?php

namespace App\Providers;

use App\Actions\CartProduct\CartProductCreateAction;
use App\Actions\CartProduct\CartProductDeleteAction;
use App\Actions\Order\OrderCreateAction;
use App\Actions\Order\OrderDeleteAction;
use App\Actions\User\UserRegisterAction;
use App\Contracts\CartProduct\CartProductCreate;
use App\Contracts\CartProduct\CartProductDelete;
use App\Contracts\Order\OrderCreate;
use App\Contracts\Order\OrderDelete;
use App\Contracts\User\UserRegistration;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    public array $bindings = [
        UserRegistration::class => UserRegisterAction::class,
        OrderCreate::class => OrderCreateAction::class,
        OrderDelete::class => OrderDeleteAction::class,
        CartProductCreate::class => CartProductCreateAction::class,
        CartProductDelete::class => CartProductDeleteAction::class,
    ];
}
