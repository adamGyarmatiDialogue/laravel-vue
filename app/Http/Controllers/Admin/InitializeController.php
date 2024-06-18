<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InitializeController extends Controller
{
    /**
     * Initialize the admins data
     *
     * @param Request $request
     */
    public function initialize(Request $request)
    {
        return response()->json([]);
    }
}
