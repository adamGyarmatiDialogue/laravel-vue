<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn("users", "name")) {
            Schema::table("users", function (Blueprint $table) {
                $table->dropColumn("name");
                $table->dropColumn("email");
                $table->dropColumn("email_verified_at");
                $table->dropColumn("remember_token");
            });
        }


        Schema::table("users", function (Blueprint $table) {
            $table->string("first_name", 255)->after("id")->nullable();
            $table->string("last_name", 255)->after("first_name")->nullable();
            $table->string("email", 512)->after("last_name")->unique();
            $table->string("username", 255)->after("email")->unique();
        });
    }

    public function down(): void
    {
        //
    }
};
