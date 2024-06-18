<?php

namespace App\Repositories;

use App\Models\UserLogin;

final class UserLoginsRepository
{
    /**
     * Create the users Login
     */
    public function create(int $userId, string $userToken, string $ipAddress, string $deviceName = "web")
    {
        UserLogin::create([
            "user_id" => $userId,
            "token" => $userToken,
            "ip_address" => $ipAddress,
            "device_name" => $deviceName,
        ]);
    }
}
