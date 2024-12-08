<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Campos permitidos para atribuição em massa.
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relacionamento inverso - um role pode estar associado a muitos usuários.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
