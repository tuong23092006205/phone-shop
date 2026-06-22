<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'address'
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function isAdmin(): bool {
        return $this->role === 'admin';
    }
}