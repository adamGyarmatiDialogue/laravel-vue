<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\SignInRequest;
use App\Http\Requests\Users\SignUpRequest;
use App\Services\Users\SignInService;
use App\Services\Users\SignUpService;

class UsersController extends Controller
{
    public function __construct(
        protected SignUpService $signUpService,
        protected SignInService $signInService,
    ) {
    }
    /**
     * Create new user
     */
    public function signUp(SignUpRequest $signUpRequest)
    {
        $this->signUpService->signUp($signUpRequest);
        return response()->json([
            "message" => "message.user.created"
        ]);
    }

    /**
     * Login in user
     *
     * @param SignInRequest $signInRequest
     */
    public function signIn(SignInRequest $signInRequest)
    {
        $this->signInService->signIn($signInRequest);
        return response()->json([
            "userToken" => $this->signInService->getUserToken(),
        ]);
    }
}
