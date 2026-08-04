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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('provider')->nullable(); // 'google', 'apple'
            $table->string('provider_id')->nullable(); // Social OAuth User ID
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(); // Nullable for social users
            $table->string('role')->default('user'); // user | admin
            $table->integer('current_day')->default(1); // 1 to 60
            $table->integer('phase')->default(0); // 0 (Onboarding), 1 (Guided), 2 (Semi-Guided), 3 (Independent)
            $table->rememberToken();
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
