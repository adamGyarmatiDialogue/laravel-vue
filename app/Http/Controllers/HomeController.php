<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the current layout
     */
    public function show()
    {
        $user = null;
        $admin = null;

        if (!$user && !$admin) {
            return view("layouts.frontend.layout");
        }

        if (!$user) {
            return view("layouts.backend.layout");
        }

        if (!$admin) {
            return view("layouts.admin.layout");
        }
    }
}
