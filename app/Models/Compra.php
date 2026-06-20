<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    // =========================
    // TABLA
    // =========================
    protected $table = 'compras';

    // =========================
    // CAMPOS EDITABLES
    // =========================
    protected $fillable = [
        'user_id',
        'total',
        'estado',
        'metodo_pago_id',
    ];

    // =========================
    // DETALLES DE LA COMPRA
    // =========================
    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class);
    }

    // =========================
    // USUARIO
    // =========================
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // =========================
    // MÉTODO DE PAGO
    // =========================
    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class);
    }

    // =========================
    // TOTAL CALCULADO (REAL)
    // =========================
    public function getTotalCalculadoAttribute()
    {
        return $this->detalles->sum('subtotal');
    }

    // =========================
    // HELPERS DE ESTADO
    // =========================
    public function esEnProceso()
    {
        return $this->estado === 'en_proceso';
    }

    public function esAbonada()
    {
        return $this->estado === 'abonado';
    }

    public function esCancelada()
    {
        return $this->estado === 'cancelado';
    }
}