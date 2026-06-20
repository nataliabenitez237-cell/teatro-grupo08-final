<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Carrito;
use Carbon\Carbon;

class LiberarCarritosExpirados extends Command
{
    protected $signature = 'carrito:expirar';
    protected $description = 'Libera carritos expirados y devuelve stock reservado';

    public function handle()
    {
        $carritos = Carrito::with('evento')
            ->where('expires_at', '<', Carbon::now())
            ->get();

        foreach ($carritos as $carrito) {

            if ($carrito->evento) {

                // liberar stock reservado
                $carrito->evento->stock_reservado -= $carrito->cantidad;
                $carrito->evento->save();
            }

            // eliminar carrito expirado
            $carrito->delete();
        }

        $this->info('Carritos expirados liberados correctamente');
    }
}