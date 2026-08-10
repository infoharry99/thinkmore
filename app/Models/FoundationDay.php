<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundationDay extends Model
{
    use HasFactory;

    protected $table = 'foundation_days';

    protected $fillable = [
        'day_number',
        'phase',
        'title',
        'domain',
        'primary_trap',
        'secondary_trap',
        'content_bundle',
    ];

    protected $casts = [
        'day_number' => 'integer',
        'phase' => 'integer',
        'content_bundle' => 'array',
    ];
}
