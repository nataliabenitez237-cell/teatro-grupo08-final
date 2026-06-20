<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Inscripcion;

class Taller extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'talleres';

    protected $fillable = [
        'nombre',
        'descripcion',
        'dias_horarios',
        'precio',
        'cupos_totales',
        'cupos_disponibles',
        'imagen',
        'activo',
    ];

    // =========================
    // RELACIÓN INSCRIPCIONES
    // =========================
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'taller_id');
    }

    // =========================
    // USUARIOS INSCRIPTOS
    // =========================
    public function usuarios()
    {
        return $this->belongsToMany(
            User::class,
            'inscripciones',
            'taller_id',
            'user_id'
        )->withTimestamps();
    }
}