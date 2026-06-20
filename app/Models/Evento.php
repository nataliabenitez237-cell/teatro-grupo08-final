<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DetalleCompra;
use Carbon\Carbon;

class Evento extends Model
{
    use HasFactory, SoftDeletes;

    // =========================
    // CAMPOS EDITABLES
    // =========================
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha',
        'hora',
        'precio',
        'stock_total',
        'stock_disponible',
        'imagen',
        'activo',
    ];

    // =========================
    // RELACIÓN CON DETALLE COMPRAS
    // =========================
    public function detalleCompras()
    {
        return $this->hasMany(DetalleCompra::class);
    }

    // =========================
    // FECHA + HORA COMO ATRIBUTO ÚNICO
    // =========================
    public function getFechaHoraAttribute()
    {
        return Carbon::parse($this->fecha . ' ' . $this->hora);
    }

    // =========================
    // VER SI SE PUEDE CANCELAR
    // =========================
    public function puedeCancelarse()
    {
        return now()->diffInHours($this->fecha_hora, false) > 1;
    }
}