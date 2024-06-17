<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users_logs', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("user_id")->index()->default(0);
            $table->string("object_name", 255)->nullable();
            $table->string("object_id", 255)->nullable();
            $table->string("event_name", 255)->nullable();
            $table->tinyInteger("status")->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_logs');
    }
};
