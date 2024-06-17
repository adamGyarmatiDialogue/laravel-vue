<?php

namespace App\Repositories;

use App\Models\UserLog;

final class UserLogsRepository
{
    public function create(int $userId, string $objectName, mixed $objectId, string $eventName): void
    {
        UserLog::create([
            "user_id" => $userId,
            "object_name" => $objectName,
            "object_id" => $objectId,
            "event_name" => $eventName,
        ]);
    }
}
