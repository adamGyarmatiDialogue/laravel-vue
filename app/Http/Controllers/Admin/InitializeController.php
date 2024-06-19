<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\Initialize\InitializeService;
use Illuminate\Http\Request;

class InitializeController extends Controller
{
    public function __construct(
        protected InitializeService $initializeService
    ) {
    }

    /**
     * Initialize the admins data
     *
     * @param Request $request
     */
    public function initialize(Request $request)
    {
        $adminData = $this->initializeService->getAdminData($request);

        return response()->json([
            "adminData" => $adminData,
        ]);
    }
}
