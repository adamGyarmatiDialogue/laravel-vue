<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "show"]);

Route::get("{any}", [HomeController::class, "show"])
    ->where("any", ".*");
