<?php

namespace App\Http\Controllers;

use App\Actions\User\GenerateUserTokenAction;
use App\Actions\User\RegisterUserAction;
use App\Helpers\UserHelper;
use App\Http\DTO\UserObject;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\User\UserResource;

class UserController extends Controller
{
    public function login(
        StoreUserRequest        $request,
        RegisterUserAction      $registerUserAction,
        GenerateUserTokenAction $generateUserTokenAction
    ): UserResource
    {
        $userData = new UserObject(...$request->validated());
        $user = $registerUserAction($userData);
        $token = $generateUserTokenAction($user);

        return UserResource::make($user)->additional(['token' => $token->plainTextToken]);
    }

    public function me(): UserResource
    {
        return UserResource::make(UserHelper::getAuthUser());
    }

}
