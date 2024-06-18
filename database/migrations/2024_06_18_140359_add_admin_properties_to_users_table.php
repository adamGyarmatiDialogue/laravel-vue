<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger("is_admin")->default(0)->after("password");
            $table->tinyInteger("is_builtin")->default(0)->after("is_admin");
            $table->tinyInteger("status")->default(1)->after("is_builtin");
        });
    }

    public function down(): void
    {
    }
};
