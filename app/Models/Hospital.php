<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    /**
     * Campos permitidos para operações de mass assignment
     */
    protected $fillable = [
        'name',
        'location',
    ];

    /**
     * Relacionamento: Um hospital tem muitos órgãos associados.
     */
    public function organs()
    {
        return $this->hasMany(Organ::class);
    }

    /**
     * Métodos personalizados podem ser adicionados aqui
     */
    public function hasOrganWithStatus($status)
    {
        return $this->organs()->where('status', $status)->exists();
    }

    /**
     * Validando dados diretamente pelo modelo (opcional).
     */
    public function validate()
    {
        return [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ];
    }
}
