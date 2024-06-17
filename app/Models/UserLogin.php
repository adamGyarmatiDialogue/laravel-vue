<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    use HasFactory;

    protected $table = "users_logins";
    protected $fillable = [
        "user_id",
        "token",
        "ip_address",
        "device_name",
    ];
}
