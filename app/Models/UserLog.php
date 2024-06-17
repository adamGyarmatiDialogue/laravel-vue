<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $table = "users_logs";
    protected $fillable = [
        "user_id",
        "object_name",
        "object_id",
        "event_name",
        "password",
    ];
}
