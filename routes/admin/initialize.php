<?php

use App\Http\Controllers\Admin\InitializeController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "/api/v1/admin/initialize"], function () {
    // Initialize the admin data
    Route::get("", [InitializeController::class, "initialize"]);
});
