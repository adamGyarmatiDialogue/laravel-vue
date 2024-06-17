<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/**
 * API routes
 */
Route::post("/api/v1/users", [UsersController::class, "signUp"]);

/**
 * App routes
 */
Route::get('/', [HomeController::class, "show"]);
Route::get("{any}", [HomeController::class, "show"])
    ->where("any", ".*");
