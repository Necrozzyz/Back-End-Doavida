<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nome da tabela no banco de dados (se necessário).
     */
    protected $table = 'hospitals'; // Opcional, caso a tabela siga a convenção, pode ser omitido.

    /**
     * Campos permitidos para operações de mass assignment.
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
     * Verifica se o hospital possui algum órgão com um status específico.
     */
    public function hasOrganWithStatus($status)
    {
        return $this->organs()->where('status', $status)->exists();
    }

    /**
     * Regras de validação.
     */
    public function validate()
    {
        return [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ];
    }
}
