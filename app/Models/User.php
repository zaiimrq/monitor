<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Role;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return true;
    }
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => Role::class,
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role == Role::Admin;
    }

    public function isTimses(): bool
    {
        return $this->role == Role::Timses;
    }

    public function isAdminOrTimses(): bool
    {
        return $this->isAdmin() || $this->isTimses();
    }

    public function canAddNewRecord(): bool
    {
        return User::where('role', Role::Timses)->pluck('id')
            ->diff(Timses::pluck('id'))
            ->isNotEmpty();
    }

    public function timses(): HasOne
    {
        return $this->hasOne(Timses::class);
    }
}
