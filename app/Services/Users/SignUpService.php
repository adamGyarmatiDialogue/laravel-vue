<?php

namespace App\Services\Users;

use App\Http\Requests\Users\SignUpRequest;
use App\Repositories\UserLogsRepository;
use App\Repositories\UsersRepository;
use App\Validators\Users\SignUpValidator;
use Illuminate\Support\Facades\DB;

final class SignUpService
{
    public function __construct(
        protected SignUpValidator $signUpValidator,
        protected UsersRepository $usersRepository,
        protected UserLogsRepository $userLogsRepository,
    ) {
    }

    /**
     * Create new user
     *
     * @param SignUpRequest $signUpRequest
     */
    public function signUp(SignUpRequest $signUpRequest)
    {
        DB::transaction(function () use ($signUpRequest) {
            // Check passwords
            $this->signUpValidator->checkPasswords(
                $signUpRequest->input("password"),
                $signUpRequest->input("reTypedPassword")
            );

            // Check the username has taken
            $this->signUpValidator->checkUsernameHasTaken(
                $signUpRequest->input("username")
            );

            // Check the email has taken
            $this->signUpValidator->checkEmailHasTaken(
                $signUpRequest->input("email")
            );

            // Create user
            $user = $this->usersRepository->create($signUpRequest);

            // Create the users log
            $this->userLogsRepository->create(
                $user->id,
                "user",
                null,
                "sign_up"
            );
        });
    }
}
