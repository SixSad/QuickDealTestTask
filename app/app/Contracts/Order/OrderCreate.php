<?php

namespace App\Contracts\Order;

use App\Http\DTO\OrderDTO;
use App\Models\Order;

interface OrderCreate
{
    public function __invoke(OrderDTO $orderDTO): Order;
}
