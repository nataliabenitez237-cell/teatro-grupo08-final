<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Evento;
use Illuminate\Http\Request;

class ReporteController extends Controller
{

    public function ventas()
    {
        $resumenEventos = DetalleCompra::select('evento_id')
            ->with('evento')
            ->selectRaw('SUM(cantidad) as total_entradas')
            ->selectRaw('SUM(subtotal) as total_recaudado')
            ->groupBy('evento_id')
            ->get();

        $totalEntradas = DetalleCompra::sum('cantidad');
        $totalRecaudado = DetalleCompra::sum('subtotal');
        $totalComisiones = Compra::count() * 2000;
        $gananciaNeta = $totalRecaudado - $totalComisiones;
        $totalCompras = Compra::count();

        return view('backend.admin.reportes.ventas', compact(
            'resumenEventos',
            'totalEntradas',
            'totalRecaudado',
            'totalComisiones',
            'gananciaNeta',
            'totalCompras'
        ));
    }
}
