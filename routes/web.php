<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/**
 * API routes
 */
require "users.php";

/**
 * Admin routes
 */
require "admin/initialize.php";

/**
 * App routes
 */
Route::get('/', [HomeController::class, "show"]);
Route::get("{any}", [HomeController::class, "show"])
    ->where("any", ".*");
