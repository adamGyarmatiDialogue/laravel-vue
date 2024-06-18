<?php

namespace App\Validators\Users;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

final class SignInValidator
{
    /**
     * Check the username or email
     * @param string $email
     * @return User
     */
    public function checkUser(string $email)
    {
        $user = User::where("username", $email)->first();

        if (!$user) {
            $user = User::where("email", $email)->first();

            if (!$user) {
                abort(Response::HTTP_NOT_FOUND, "message.wrong_login_data");
            }
        }

        return $user;
    }

    /**
     * Check the user's password
     * @param User $user
     * @param string $password
     */
    public function checkPassword(User $user, string $password)
    {
        if (!Hash::check($password, $user->password)) {
            abort(Response::HTTP_FORBIDDEN, "message.wrong_password");
        }
    }
}
