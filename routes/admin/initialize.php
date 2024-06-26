<?php

use App\Http\Controllers\Admin\InitializeController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::group([
    "prefix" => "/api/v1/admin/initialize",
    "middleware" => [AdminAuth::class]
], function () {
    // Initialize the admin data
    Route::get("", [InitializeController::class, "initialize"]);
});
