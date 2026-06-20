<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CompraController extends Controller
{
    // =========================
    // LISTADO DE COMPRAS
    // =========================
    public function index(Request $request)
    {
        $query = Compra::where('user_id', Auth::id())
            ->with('detalles.evento')
            ->orderBy('id', 'desc');

        // Filtros
        if ($request->filled('fecha')) {
            $query->whereDate('created_at', $request->fecha);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        // Total recalculado desde detalles
        $compras = $query->get()->map(function ($compra) {
            $compra->total_calculado = $compra->detalles->sum('subtotal');
            return $compra;
        });

        return view('backend.cliente.compras.index', compact('compras'));
    }

    // =========================
    // DETALLE COMPRA
    // =========================
    public function show($id)
    {
        $compra = Compra::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('detalles.evento')
            ->firstOrFail();

        $compra->total_calculado = $compra->detalles->sum('subtotal');

        return view('backend.cliente.compras.show', compact('compra'));
    }

    // =========================
    // CONFIRMAR PAGO
    // =========================
    public function confirmarPago($id)
    {
        $compra = Compra::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('detalles.evento')
            ->firstOrFail();

        if ($compra->estado !== 'en_proceso') {
            return back()->with('error', 'La compra ya fue procesada');
        }

        // Validar stock
        foreach ($compra->detalles as $detalle) {
            if ($detalle->evento->stock_disponible < $detalle->cantidad) {
                return back()->with(
                    'error',
                    'Stock insuficiente para ' . $detalle->evento->nombre
                );
            }
        }

        // Descontar stock
        foreach ($compra->detalles as $detalle) {
            $detalle->evento->decrement('stock_disponible', $detalle->cantidad);
        }

        $compra->update([
            'estado' => 'abonado',
            'total' => $compra->detalles->sum('subtotal')
        ]);

        return back()->with('success', 'Pago confirmado correctamente');
    }

    // =========================
    // CANCELAR COMPRA
    // =========================
    public function cancelar($id)
    {
        $compra = Compra::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('detalles.evento')
            ->firstOrFail();

        if (!in_array($compra->estado, ['en_proceso', 'abonado'])) {
            return back()->with('error', 'No se puede cancelar esta compra');
        }

        // =========================
        // REGLA: 1 HORA ANTES DEL EVENTO
        // =========================
        foreach ($compra->detalles as $detalle) {

            $eventoFechaHora = Carbon::parse(
                $detalle->evento->fecha . ' ' . $detalle->evento->hora
            );

            if (now()->diffInMinutes($eventoFechaHora, false) < 60) {
                return back()->with(
                    'error',
                    'No se puede cancelar con menos de 1 hora de anticipación'
                );
            }
        }

        // Si estaba abonada, devolver stock
        if ($compra->estado === 'abonado') {
            foreach ($compra->detalles as $detalle) {
                $detalle->evento->increment('stock_disponible', $detalle->cantidad);
            }
        }

        $compra->update([
            'estado' => 'cancelado'
        ]);

        return back()->with('success', 'Compra cancelada correctamente');
    }

    // =========================
    // PDF
    // =========================
    public function pdf($id)
    {
        $compra = Compra::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('detalles.evento')
            ->firstOrFail();

        $compra->total_calculado = $compra->detalles->sum('subtotal');

        $pdf = Pdf::loadView('backend.cliente.compras.pdf', compact('compra'));

        return $pdf->download('compra_' . $compra->id . '.pdf');
    }
}