<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'student_id',
        'last_name',
        'first_name',
        'year_and_section',
        'college',
        'name',
        'email',
        'password',
        'role',
        'has_voted',
        'voted_at',
        'qr_code_token',
        'qr_verified',
        'qr_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'voted_at' => 'datetime',
            'qr_verified_at' => 'datetime',
            'password' => 'hashed',
            'has_voted' => 'boolean',
            'qr_verified' => 'boolean',
        ];
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function hasVoted(): bool
    {
        return $this->has_voted === true;
    }

    public function getFullNameAttribute(): string
    {
        return trim(($this->last_name ?? '') . ', ' . ($this->first_name ?? ''));
    }
}