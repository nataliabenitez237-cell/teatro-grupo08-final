<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;

    // =========================
    // TABLA DE LA BD
    // =========================
    protected $table = 'detalle_compras';

    // =========================
    // CAMPOS QUE SE PUEDEN GUARDAR
    // =========================
    protected $fillable = [
        'compra_id',
        'evento_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    // =========================
    // RELACIÓN: pertenece a una compra
    // =========================
    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    // =========================
    // RELACIÓN: pertenece a un evento
    // =========================
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}