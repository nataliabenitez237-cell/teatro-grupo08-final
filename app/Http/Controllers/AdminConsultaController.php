<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class AdminConsultaController extends Controller
{
    public function index(Request $request)
    {
        $query = Consulta::query();

        // Buscar por nombre o email
        if ($request->filled('buscar')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->buscar . '%')
                  ->orWhere('email', 'like', '%' . $request->buscar . '%');
            });
        }

        // Filtrar por estado (Leída / No leída)
        if ($request->filled('estado')) {
            $query->where('leido', $request->estado);
        }

        // Filtrar por tipo de consulta
        if ($request->filled('tipo_consulta')) {
            $query->where('tipo_consulta', $request->tipo_consulta);
        }

        $consultas = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('backend.admin.consultas.index', compact('consultas'));
    }

    public function marcarLeida($id)
    {
        $consulta = Consulta::findOrFail($id);

        $consulta->leido = true;
        $consulta->save();

        return redirect()
            ->back()
            ->with('success', 'Consulta marcada como leída');
    }

    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id);

        $consulta->delete();

        return redirect()
            ->back()
            ->with('success', 'Consulta eliminada correctamente');
    }
}