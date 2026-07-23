<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_id')->unique(); // e.g. P1-014
            $table->string('domain'); // Relationships/Family, Career, Healthcare, etc.
            $table->integer('phase_target')->default(1); // 1, 2, or 3
            $table->json('trap_target'); // Array of active traps (e.g. ["Mind Reading", "Emotional Reasoning"])
            $table->text('opening_scenario'); // The ambiguous real-life scenario
            $table->json('step1_detect')->nullable(); // Model fact_line & story_line
            $table->json('step2_decode')->nullable(); // Model trap classification & explanation
            $table->json('step3_reality_check')->nullable(); // 5 fixed Socratic questions
            $table->json('step4_reframe')->nullable(); // 3-4 model alternative explanations
            $table->json('step5_intervention')->nullable(); // Single recommended action & rationale
            $table->json('step6_internalize')->nullable(); // Model universal principle (1 line)
            $table->string('recurrence_case_id')->nullable(); // Linked resurfacing case ID
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
