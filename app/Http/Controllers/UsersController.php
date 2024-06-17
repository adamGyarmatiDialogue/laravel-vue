<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\SignUpRequest;
use App\Services\Users\SignUpService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct(
        protected SignUpService $signUpService
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
}
