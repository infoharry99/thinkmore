<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for Foundation Course 60-day Feedback Survey (PDF 1).
     */
    public function up(): void
    {
        Schema::create('foundation_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Q1 — Judgment Impact (Required 1-5 star)
            $table->unsignedTinyInteger('judgment_impact_score'); 
            
            // Q2 — Real-World Application (Required Enum)
            $table->enum('technique_applied', [
                'multiple',
                'once_or_twice',
                'not_yet',
                'dont_remember'
            ]);
            
            // Q3 — Recommend Likelihood (Required 1-5 star)
            $table->unsignedTinyInteger('recommend_score');
            
            // Conditional Field A — Testimonial (Optional, shown when judgment_impact_score >= 4)
            $table->string('testimonial_text', 280)->nullable();
            
            // Conditional Field B — Improvement Feedback (Optional, shown when judgment_impact_score <= 2)
            $table->string('improvement_feedback', 280)->nullable();
            
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foundation_feedbacks');
    }
};
