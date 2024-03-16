<?php

namespace App\Actions\Balance;

use App\Models\Balance;

class ChangeBalanceAction
{

    public function __invoke(int $userId, int $sum, bool $replenishment = true): bool
    {
        /** @var Balance $balance */
        $balance = Balance::query()
            ->where('user_id', $userId)
            ->firstOrFail();

        $replenishment
            ? $balance->balance += $sum
            : $balance->balance -= $sum;

        return $balance->save();
    }

}
