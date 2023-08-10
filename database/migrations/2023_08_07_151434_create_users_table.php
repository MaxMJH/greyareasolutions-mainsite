<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('email', 255)->unique()->nullable($value = false);
            $table->string('password', 255)->nullable($value = false);
            $table->string('firstname', 50)->nullable($value = false);
            $table->string('lastname', 50)->nullable($value = false);
            $table->enum('role', ['user', 'blogger', 'admin'])->default($default = 'user')->nullable($value = false);
            $table->timestamp('last_login', $precision = 0)->nullable($value = true);
            $table->unsignedTinyInteger('failed_attempts')->default($value = 0)->nullable($value = false);
            $table->unsignedTinyInteger('is_locked')->default($value = 0)->nullable($value = false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
