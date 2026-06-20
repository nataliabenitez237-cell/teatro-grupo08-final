<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class AdminEventoController extends Controller
{
    // =========================
    // LISTADO
    // =========================
    public function index(Request $request)
    {
        $estado = $request->estado;

        $query = Evento::withTrashed();

        if ($estado === 'activos') {
            $query->whereNull('deleted_at')
                  ->where('activo', true);
        }

        if ($estado === 'inactivos') {
            $query->whereNull('deleted_at')
                  ->where('activo', false);
        }

        if ($estado === 'eliminados') {
            $query->onlyTrashed();
        }

        $eventos = $query
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view(
            'backend.admin.eventos.index',
            compact('eventos', 'estado')
        );
    }

    // =========================
    // CREAR
    // =========================
    public function create()
    {
        $eventos = Evento::orderBy('id', 'desc')->get();

        return view(
            'backend.admin.eventos.create',
            compact('eventos')
        );
    }

    // =========================
    // GUARDAR
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'descripcion'  => 'nullable|string',
            'fecha'        => 'required|date',
            'hora'         => 'required',
            'precio'       => 'required|numeric',
            'stock_total'  => 'required|integer|min:1',
            'activo'       => 'required|boolean',
            'imagen'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // Imagen
        if ($request->hasFile('imagen')) {

            $imagen = $request->file('imagen');

            $nombreImagen =
                time() . '.' .
                $imagen->getClientOriginalExtension();

            $imagen->move(
                public_path('img/proxEventos'),
                $nombreImagen
            );

            $data['imagen'] = $nombreImagen;
        }

        // Stock inicial
        $data['stock_disponible'] = $request->stock_total;

        // Estado
        $data['activo'] = $request->activo;

        Evento::create($data);

        return redirect()
            ->route('admin.eventos.index')
            ->with(
                'success',
                'Evento creado correctamente'
            );
    }

    // =========================
    // EDITAR
    // =========================
    public function edit($id)
    {
        $evento = Evento::findOrFail($id);

        return view(
            'backend.admin.eventos.edit',
            compact('evento')
        );
    }

    // =========================
    // ACTUALIZAR
    // =========================
    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);

        $request->validate([
            'nombre'       => 'required|string|max:255',
            'descripcion'  => 'nullable|string',
            'fecha'        => 'required|date',
            'hora'         => 'required',
            'precio'       => 'required|numeric',
            'stock_total'  => 'required|integer|min:1',
            'activo'       => 'required|boolean',
            'imagen'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // Imagen nueva
        if ($request->hasFile('imagen')) {

            if (
                $evento->imagen &&
                file_exists(
                    public_path(
                        'img/proxEventos/' . $evento->imagen
                    )
                )
            ) {
                unlink(
                    public_path(
                        'img/proxEventos/' . $evento->imagen
                    )
                );
            }

            $imagen = $request->file('imagen');

            $nombreImagen =
                time() . '.' .
                $imagen->getClientOriginalExtension();

            $imagen->move(
                public_path('img/proxEventos'),
                $nombreImagen
            );

            $data['imagen'] = $nombreImagen;
        }

        // Entradas vendidas
        $vendidas =
            $evento->stock_total -
            $evento->stock_disponible;

        // Evita reducir stock por debajo de lo vendido
        if ($request->stock_total < $vendidas) {

            return back()
                ->withErrors([
                    'stock_total' =>
                    'No puede ser menor a las entradas ya vendidas.'
                ])
                ->withInput();
        }

        // Recalcula stock disponible
        $data['stock_disponible'] =
            $request->stock_total - $vendidas;

        // Estado
        $data['activo'] = $request->activo;

        $evento->update($data);

        return redirect()
            ->route('admin.eventos.index')
            ->with(
                'success',
                'Evento actualizado correctamente'
            );
    }

    // =========================
    // BAJA LÓGICA
    // =========================
    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);

        $evento->delete();

        return redirect()
            ->route('admin.eventos.index')
            ->with(
                'success',
                'Evento dado de baja correctamente'
            );
    }

    // =========================
    // RESTAURAR
    // =========================
    public function restore($id)
    {
        $evento = Evento::withTrashed()
            ->findOrFail($id);

        $evento->restore();

        return redirect()
            ->route('admin.eventos.index')
            ->with(
                'success',
                'Evento restaurado correctamente'
            );
    }
}