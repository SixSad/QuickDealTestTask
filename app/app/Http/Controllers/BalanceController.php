<?php

namespace App\Http\Controllers;

use App\Actions\Balance\ChangeBalanceAction;
use App\Exceptions\UnableToUpdateException;
use App\Helpers\UserHelper;
use App\Http\Requests\UpdateBalanceRequest;
use App\Http\Resources\Balance\BalanceResource;

class BalanceController extends Controller
{

    public function index(): BalanceResource
    {
        return BalanceResource::make(UserHelper::getBalance());
    }

    //Написал отдельный нейминг роут, чтобы не усложнять. На расширение добавлял отдельные сущности для обновления баланса.

    /**
     * @throws UnableToUpdateException
     */
    public function addBalance(UpdateBalanceRequest $request, ChangeBalanceAction $changeBalanceAction): BalanceResource
    {
        $balance = UserHelper::getBalance();

        $changeBalanceAction(
            $balance,
            $request->get('balance'),
            true
        );

        return BalanceResource::make($balance);
    }
}
