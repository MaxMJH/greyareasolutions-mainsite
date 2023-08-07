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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id('blog_id');
            $table->tinyText('blog_title')->unique()->nullable($value = false);
            $table->text('blog_abstract')->nullable($value = false);
            $table->longText('blog_content')->nullable($value = false);
            $table->timestamp('blog_creation_date', $precision = 0)->nullable($value = false);
            $table->foreignId('user_id')->constrained('users', 'user_id')->nullable($value = false);
            $table->string('blog_image')->nullable($value = false);
            $table->string('blog_slug', 255)->nullable($value = false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
