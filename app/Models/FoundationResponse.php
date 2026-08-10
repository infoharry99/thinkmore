<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundationResponse extends Model
{
    use HasFactory;

    protected $table = 'foundation_responses';

    protected $fillable = [
        'user_id',
        'day_number',
        'phase',
        'responses',
        'input_method',
        'started_at',
        'completed_at',
        'status',
    ];

    protected $casts = [
        'day_number' => 'integer',
        'phase' => 'integer',
        'responses' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
