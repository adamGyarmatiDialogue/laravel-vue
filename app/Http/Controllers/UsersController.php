<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\SignUpRequest;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Create new user
     */
    public function signUp(SignUpRequest $signUpRequest)
    {
        return response()->json([]);
    }
}
