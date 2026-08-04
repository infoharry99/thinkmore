<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->integer('day_number')->default(1)->index()->after('id');
            $table->string('primary_trap')->nullable()->after('domain');
            $table->string('secondary_trap')->nullable()->after('primary_trap');
            $table->string('difficulty')->default('Beginner')->after('secondary_trap');
            $table->string('primary_skill')->nullable()->after('difficulty');
            $table->text('mission')->nullable()->after('primary_skill');
            $table->text('learning_objective')->nullable()->after('mission');
            $table->text('closing_reflection')->nullable()->after('step6_internalize');
            $table->json('developer_notes')->nullable()->after('closing_reflection');
        });
    }

    public function down(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->dropColumn([
                'day_number',
                'primary_trap',
                'secondary_trap',
                'difficulty',
                'primary_skill',
                'mission',
                'learning_objective',
                'closing_reflection',
                'developer_notes',
            ]);
        });
    }
};
