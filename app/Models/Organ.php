<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organ extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Campos permitidos para operações de mass assignment.
     */
    protected $fillable = [
        'name',
        'status',
        'hospital_id',
    ];

    /**
     * Define o relacionamento entre Organ e Hospital.
     */
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    /**
     * Regras de validação.
     */
    public function validate()
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:waiting,available',
            'hospital_id' => 'required|integer|exists:hospitals,id',
        ];
    }

    /**
     * Valores possíveis para o campo status.
     */
    public static function statuses()
    {
        return ['waiting', 'available'];
    }
}
