<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'mensaje',
        'leido'
    ];

    // Valor por defecto para nuevas consultas
    protected $attributes = [
        'leido' => false,
    ];
}