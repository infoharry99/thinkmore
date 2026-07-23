<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reflection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'case_id',
        'day_number',
        'internalize_text',
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
