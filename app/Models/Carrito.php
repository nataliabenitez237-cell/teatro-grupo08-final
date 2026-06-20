<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carrito';

    protected $fillable = [
        'user_id',
        'session_id',
        'evento_id', 
        'taller_id',
        'cantidad',
        'expires_at',
    ];

    // =========================
    // USUARIO
    // =========================
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function evento()
    {
        return $this->belongsTo(Evento::class);  //  DEBE ESTAR
    }

    // =========================
    // TALLER
    // =========================
    public function taller()
    {
        return $this->belongsTo(Taller::class);
    }

    // =========================
    // VER SI EXPIRÓ
    // =========================
    public function expiro()
    {
        return $this->expires_at && now()->greaterThan($this->expires_at);
    }
}