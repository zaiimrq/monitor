<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $with = [
        'timses'
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => Role::class
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
