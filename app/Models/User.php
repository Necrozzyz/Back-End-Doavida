<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Campos permitidos para atribuição em massa
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];

    /**
     * Campos a serem ocultos nos retornos de JSON
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Cast para garantir formatação correta dos campos
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
