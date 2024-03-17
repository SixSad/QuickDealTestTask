<?php

namespace App\Actions\Balance;

use App\Exceptions\UnableToUpdateException;
use App\Models\Balance;
use Exception;

class ChangeBalanceAction
{

    /**
     * @throws UnableToUpdateException
     */
    public function __invoke(Balance $balance, float $sum, bool $replenishment): bool
    {
        try {
            $replenishment
                ? $balance->balance += $sum
                : $balance->balance -= $sum;

            if (!$balance->save()) throw new Exception();

            return true;
        } catch (Exception) {
            throw new UnableToUpdateException();
        }
    }

}
