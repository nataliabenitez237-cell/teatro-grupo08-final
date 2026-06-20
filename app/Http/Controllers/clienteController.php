<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Compra;
use App\Models\Inscripcion;
use Barryvdh\DomPDF\Facade\Pdf;

class ClienteController extends Controller
{
    public function index()
    {
        return view('cliente.cliente');
    }

    public function historial(Request $request)
    {
        $user = Auth::user();
        
        $compras = Compra::where('user_id', $user->id)
            ->when($request->fecha, function($query, $fecha) {
                return $query->whereDate('created_at', $fecha);
            })
            ->when($request->id, function($query, $id) {
                return $query->where('id', $id);
            })
            ->with('detalles.evento')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('cliente.compras.index', compact('compras'));
    }

    public function talleres()
    {
        $talleres = Auth::user()
            ->talleres()
            ->orderBy('inscripciones.created_at', 'desc')
            ->get();

        return view('cliente.talleres', compact('talleres'));
    }

    // =========================
    // PERFIL CLIENTE
    // =========================

    public function perfil()
    {
        return view('cliente.perfil', [
            'usuario' => Auth::user()
        ]);
    }

    public function actualizarPerfil(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->apellido = $request->apellido;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:6|confirmed'
            ]);

            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Perfil actualizado correctamente');
    }

    // =========================
    // PDF DE LA COMPRA
    // =========================
          public function pdfCompra($id)
       { 
            $compra = Compra::where('user_id', Auth::id())
                 ->with('detalles.evento', 'user')
                 ->findOrFail($id);
    
            $pdf = Pdf::loadView('pdf.compra', compact('compra'));
    
            return $pdf->download('factura-compra-' . $compra->id . '.pdf');
        }
    // =========================
    // CANCELAR COMPRA
    // =========================
    public function cancelarCompra($id)
    {
        $compra = Compra::where('user_id', Auth::id())
            ->where('estado', 'en_proceso')
            ->findOrFail($id);
        
        // Actualizar el estado de la compra
        $compra->update(['estado' => 'cancelada']);
        
        // Devolver los cupos/stock (opcional)
        // Aquí podrías incrementar el stock de los eventos si quieres
        
        return back()->with('success', 'Compra #' . $id . ' cancelada correctamente.');
    }

    // =========================
    // DETALLE DE COMPRA (opcional)
    // =========================
    public function detalleCompra($id)
    {
        $compra = Compra::where('user_id', Auth::id())
            ->with('detalles.evento')
            ->findOrFail($id);

        return view('cliente.compras.detalle', compact('compra'));
    }
}