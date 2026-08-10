<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Foundation Curriculum Days Content Table
        if (!Schema::hasTable('foundation_days')) {
            Schema::create('foundation_days', function (Blueprint $table) {
                $table->id();
                $table->integer('day_number')->unique()->index();
                $table->integer('phase')->default(1);
                $table->string('title');
                $table->string('domain');
                $table->string('primary_trap')->nullable();
                $table->string('secondary_trap')->nullable();
                $table->longText('content_bundle'); // Full Day JSON Bundle
                $table->timestamps();
            });
        }

        // 2. Foundation User Saved & Completed Responses Table
        if (!Schema::hasTable('foundation_responses')) {
            Schema::create('foundation_responses', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->integer('day_number')->index();
                $table->integer('phase')->default(1);
                $table->longText('responses'); // JSON responses object
                $table->string('input_method')->default('typed');
                $table->timestamp('started_at')->nullable();
                $table->timestamp('completed_at')->nullable();
                $table->string('status')->default('completed'); // 'in_progress', 'completed'
                $table->timestamps();

                $table->unique(['user_id', 'day_number']);
            });
        }

        // 3. Add day0_completed flag to users table if missing
        if (!Schema::hasColumn('users', 'day0_completed')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('day0_completed')->default(true)->after('phase');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('foundation_responses');
        Schema::dropIfExists('foundation_days');
        if (Schema::hasColumn('users', 'day0_completed')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('day0_completed');
            });
        }
    }
};
