<?php

namespace App\Http\Controllers;

use App\Actions\Balance\ChangeBalanceAction;
use App\Exceptions\UnableToUpdateException;
use App\Helpers\UserHelper;
use App\Http\DTO\BalanceObject;
use App\Http\Requests\UpdateBalanceRequest;
use App\Http\Resources\Balance\BalanceResource;

class BalanceController extends Controller
{

    public function index(): BalanceResource
    {
        return BalanceResource::make(UserHelper::getAuthUser()->balance);
    }

    //Написал отдельный нейминг роут, чтобы не усложнять.
    // По хорошему делать систему с платежами и отдельными моделями, которые автоматически пополняют баланс.
    /**
     * @throws UnableToUpdateException
     */
    public function addBalance(UpdateBalanceRequest $request, ChangeBalanceAction $changeBalanceAction): BalanceResource
    {
        $balanceObject = new BalanceObject(...$request->validated());

        if (!$changeBalanceAction(UserHelper::getAuthUserId(), $balanceObject->balance)) {
            throw new UnableToUpdateException();
        }

        return BalanceResource::make(UserHelper::getBalance());
    }
}
