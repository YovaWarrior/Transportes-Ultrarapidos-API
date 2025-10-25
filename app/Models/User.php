<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'active' => 'boolean',
        ];
    }

    // Helper methods for roles
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isOperativo(): bool
    {
        return $this->role === 'operativo';
    }

    public function isPiloto(): bool
    {
        return $this->role === 'piloto';
    }

    // Permissions helper methods
    public function canCreate(): bool
    {
        return in_array($this->role, ['admin', 'operativo']);
    }

    public function canEdit(): bool
    {
        return in_array($this->role, ['admin', 'operativo']);
    }

    public function canDelete(): bool
    {
        return $this->role === 'admin';
    }

    public function canOnlyView(): bool
    {
        return $this->role === 'piloto';
    }

    // Relationships for reporting
    public function valesCombustible()
    {
        return $this->hasMany(\App\Models\ValeCombustible::class);
    }
}