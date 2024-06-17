<?php

namespace App\Validators\Users;

use App\Models\User;
use Illuminate\Http\Response;

final class SignUpValidator
{
    /**
     * Check the passwords
     * @param string $password
     * @param string $reTypedPassword
     *
     * @return HTTP_UNPROCESSABLE_ENTITY or True
     */
    public function checkPasswords(string $password, string $reTypedPassword)
    {
        if ($password !== $reTypedPassword) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, "validation.passowrd.missmatch");
        }
    }

    /**
     * Check in the db the username is already exists
     *
     * @param string $username
     */
    public function checkUsernameHasTaken(string $username)
    {
        $user = User::select("id")
            ->where("username", $username)
            ->first();

        if ($user !== null) {
            abort(Response::HTTP_FORBIDDEN, "message.username.taken");
        }
    }

    /**
     * Check in the db email has taken
     *
     * @param string $email
     */
    public function checkEmailHasTaken(string $email)
    {
        $user = User::select("id")->where("email", $email)->first();

        if ($user !== null) {
            abort(Response::HTTP_FORBIDDEN, "message.email.taken");
        }
    }
}
