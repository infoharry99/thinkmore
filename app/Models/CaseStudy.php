<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    use HasFactory;

    protected $table = 'cases';

    protected $fillable = [
        'day_number',
        'case_id',
        'domain',
        'primary_trap',
        'secondary_trap',
        'difficulty',
        'primary_skill',
        'mission',
        'learning_objective',
        'phase_target',
        'trap_target',
        'opening_scenario',
        'step1_detect',
        'step2_decode',
        'step3_reality_check',
        'step4_reframe',
        'step5_intervention',
        'step6_internalize',
        'closing_reflection',
        'developer_notes',
        'recurrence_case_id',
        'is_active',
    ];

    protected $casts = [
        'day_number' => 'integer',
        'phase_target' => 'integer',
        'trap_target' => 'array',
        'step1_detect' => 'array',
        'step2_decode' => 'array',
        'step3_reality_check' => 'array',
        'step4_reframe' => 'array',
        'step5_intervention' => 'array',
        'step6_internalize' => 'array',
        'developer_notes' => 'array',
        'is_active' => 'boolean',
    ];
}
