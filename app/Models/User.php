<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'current_day',
        'phase',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'current_day' => 'integer',
        'phase' => 'integer',
    ];

    public function reflections()
    {
        return $this->hasMany(Reflection::class);
    }

    public function progressChecks()
    {
        return $this->hasMany(ProgressCheck::class);
    }

    public function foundationFeedbacks()
    {
        return $this->hasMany(FoundationFeedback::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
