<?php

namespace App\Services\Users;

use App\Http\Requests\Users\SignInRequest;
use App\Repositories\UserLoginsRepository;
use App\Repositories\UserLogsRepository;
use App\Repositories\UsersRepository;
use App\Validators\Users\SignInValidator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

final class SignInService
{
    private string $userToken;

    public function __construct(
        protected SignInValidator $signInValidator,
        protected UsersRepository $usersRepository,
        protected UserLoginsRepository $userLoginsRepository,
        protected UserLogsRepository $userLogsRepository,
    ) {
    }

    /**
     * Sign In
     *
     * @param SignInRequest $signInRequest
     */
    public function signIn(SignInRequest $signInRequest)
    {
        DB::transaction(function () use ($signInRequest) {
            // Check the user email or username
            $user = $this->signInValidator->checkUser($signInRequest->input("email"));

            // Check the user passowrd
            $this->signInValidator->checkPassword($user, $signInRequest->input("password"));

            // Create the user's token
            $this->userToken = $this->usersRepository->createUserToken($user->id);

            // Save the users token as a session
            Session::put("userToken", $this->userToken);

            // Create the users Log in
            $this->userLoginsRepository
                ->create(
                    $user->id,
                    $this->userToken,
                    $signInRequest->ip()
                );

            // Create the user Logs
            $this->userLogsRepository
                ->create(
                    $user->id,
                    "user",
                    null,
                    "sign_in"
                );
        });
    }

    public function getUserToken(): string
    {
        return $this->userToken;
    }
}
