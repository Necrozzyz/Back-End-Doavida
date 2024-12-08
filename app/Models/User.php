<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    /**
     * Campos permitidos para atribuição em massa.
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id',
    ];

    /**
     * Campos ocultos nos retornos de JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast para garantir formatação correta dos campos.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define as regras de validação para o modelo User.
     */
    public static function rules($id = null)
    {
        return [
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email' . ($id ? ",$id" : ''),
            'password' => 'nullable|string|min:6',
            'role_id' => 'required|exists:roles,id', // Validação para garantir que o role_id existe na tabela roles
        ];
    }

    /**
     * Relacionamento com a tabela roles.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Verifica se o usuário é administrador.
     */
    public function isAdmin()
    {
        return $this->role && $this->role->name === 'admin';
    }

    /**
     * Verifica se o usuário é um doador.
     */
    public function isDoador()
    {
        return $this->role && $this->role->name === 'doador';
    }

    /**
     * Verifica se o usuário é um receptor.
     */
    public function isReceptor()
    {
        return $this->role && $this->role->name === 'receptor';
    }

    /**
     * Garante que o password seja sempre criptografado.
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Retorna o nome do papel associado ao usuário.
     */
    protected $appends = ['role_name'];

    public function getRoleNameAttribute()
    {
        return $this->role ? $this->role->name : null;
    }

    /**
     * Define o papel padrão ao criar um novo usuário, se não for especificado.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->role_id)) {
                $user->role_id = Role::where('name', 'receptor')->value('id');
            }
        });
    }
}
