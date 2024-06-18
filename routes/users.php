<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// USers routes
Route::group(["prefix" => "/api/v1/users"], function () {
    Route::post("", [UsersController::class, "signUp"]);
    Route::post("/login", [UsersController::class, "signIn"]);
});
