<?php

namespace App\Services\Admin\Initialize;

use Illuminate\Http\Request;

final class InitializeService
{

    /**
     * Get admin data
     *
     * @param Request $request
     * @return array The admins data
     */
    public function getAdminData(Request $request)
    {
        $admin = $request->admin;

        return [
            "firstName" => $admin->first_name,
            "lastName" => $admin->last_name,
        ];
    }
}
