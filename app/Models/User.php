<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'public_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $attributes = [
        'phone' => null,
        'country' => 'CN',
        'status' => 'active',
        'is_admin' => false,
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        $allowedDomains = ['link.com'];
        $emailDomain = explode('@', $this->email)[1] ?? null;
        return in_array($emailDomain, $allowedDomains);
    }
}