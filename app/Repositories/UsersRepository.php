<?php

namespace App\Repositories;

use App\Http\Requests\Users\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class UsersRepository
{
    /**
     * Create user
     *
     * @param SignUpRequest $signUpRequest
     */
    public function create(SignUpRequest $signUpRequest): User
    {
        return User::create([
            "first_name" => $signUpRequest->input("firstName"),
            "last_name" => $signUpRequest->input("lastName"),
            "email" => $signUpRequest->input("email"),
            "username" => $signUpRequest->input("username"),
            "password" => Hash::make($signUpRequest->input("password")),
        ]);
    }

    /**
     * Create token to the user
     *
     * @param int $userId - The user's id
     * @return string token - The user's token
     */
    public function createUserToken(int $userId): string
    {
        return base64_encode(
            Str::random(25) . ";" .
                $userId . ";" .
                Str::random(25)
        );
    }
}
