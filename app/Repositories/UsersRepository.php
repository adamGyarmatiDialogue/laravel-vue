<?php

namespace App\Repositories;

use App\Http\Requests\Users\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            "password" => Hash::make($signUpRequest->input("username")),
        ]);
    }
}
