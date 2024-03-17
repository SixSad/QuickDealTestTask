<?php

namespace App\Contracts\Order;

use App\Http\DTO\OrderDTO;

interface OrderDelete
{
    public function __invoke(OrderDTO $orderDTO): bool;
}
