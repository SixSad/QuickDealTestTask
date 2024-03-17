<?php

namespace App\Actions\User;

use App\Contracts\User\UserRegistration;
use App\Http\DTO\UserObject;
use App\Models\User;

class UserRegisterAction implements UserRegistration
{

    public function __invoke(UserObject $userObject): User
    {
        /** @var User $user */
        $user = User::query()->firstOrCreate(['email' => $userObject->email]);
        return $user;
    }

}
