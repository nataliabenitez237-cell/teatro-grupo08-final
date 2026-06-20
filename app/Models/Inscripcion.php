<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Taller;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';

    protected $fillable = [
        'user_id',
        'taller_id',
    ];

    // (opcional pero recomendado)
    public $timestamps = true;

    // =========================
    // USUARIO
    // =========================
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // =========================
    // TALLER
    // =========================
    public function taller()
    {
        return $this->belongsTo(Taller::class, 'taller_id');
    }
}