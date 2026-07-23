<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundationFeedback extends Model
{
    use HasFactory;

    protected $table = 'foundation_feedbacks';

    protected $fillable = [
        'user_id',
        'judgment_impact_score',
        'technique_applied',
        'recommend_score',
        'testimonial_text',
        'improvement_feedback',
        'submitted_at',
    ];

    protected $casts = [
        'judgment_impact_score' => 'integer',
        'recommend_score' => 'integer',
        'submitted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
