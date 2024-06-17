<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users_logins', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("user_id")->index()->default(0);
            $table->string("token", 255)->unique();
            $table->string("ip_address", 255)->index()->nullable();
            $table->string("device_name", 255)->nullable()->default("web");
            $table->tinyInteger("status")->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_logins');
    }
};
