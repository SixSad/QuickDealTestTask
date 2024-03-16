<?php

namespace App\Services;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BalanceService
{

    public function __construct(private readonly Balance $balance)
    {
    }

    public function getBalanceByUserId(int $userId): Model|Builder
    {
        return $this->balance
            ->newQuery()
            ->where('user_id', $userId)
            ->firstOrFail();
    }

    public function updateBalanceByUserId(int $userId, int $sum, bool $replenishment = true): Balance
    {
        /** @var Balance $balance */
        $balance = $this->getBalanceByUserId($userId);

        $replenishment
            ? $balance->balance += $sum
            : $balance->balance -= $sum;

        $balance->save();

        return $balance;
    }

}
