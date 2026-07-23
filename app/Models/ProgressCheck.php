<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'case_id',
        'day_number',
        'fact_line',
        'story_line',
        'trap_selected',
        'user_reframe',
        'user_action',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'day_number' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function caseStudy()
    {
        return $this->belongsTo(CaseStudy::class, 'case_id');
    }
}
