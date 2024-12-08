<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organ extends Model
{
    use HasFactory;

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
}
