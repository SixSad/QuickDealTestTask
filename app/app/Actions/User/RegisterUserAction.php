<?php

namespace App\Actions\User;

use App\Http\DTO\UserObject;
use App\Models\User;

class RegisterUserAction
{

    public function __invoke(UserObject $userObject): User
    {
        /** @var User $user */
        $user = User::query()->firstOrCreate(['email' => $userObject->email]);
        return $user;
    }

}
