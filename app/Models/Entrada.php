<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $fillable = ['compra_id', 'evento_id', 'cantidad', 'precio_unitario', 'subtotal'];

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}