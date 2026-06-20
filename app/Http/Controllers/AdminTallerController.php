<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use Illuminate\Http\Request;

class AdminTallerController extends Controller
{
    // =========================
    // LISTADO
    // =========================
    public function index()
    {
        $talleres = Taller::withTrashed()
            ->withCount('inscripciones')
            ->orderBy('nombre')
            ->paginate(10);

        return view('backend.admin.talleres.index', compact('talleres'));
    }

    // =========================
    // FORM CREAR
    // =========================
    public function create()
    {
        return view('backend.admin.talleres.create');
    }

    // =========================
    // GUARDAR
    // =========================
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'dias_horarios' => 'required|max:255',
            'precio' => 'required|numeric|min:0',
            'cupos_totales' => 'required|integer|min:1',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $data['cupos_disponibles'] = $data['cupos_totales'];
        $data['activo'] = $request->has('activo') ? 1 : 0;

        // =========================
        // IMAGEN (PUBLIC /img/talleres)
        // =========================
        if ($request->hasFile('imagen')) {

            $file = $request->file('imagen');
            $nombre = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('img/talleres'), $nombre);

            $data['imagen'] = $nombre;
        }

        Taller::create($data);

        return redirect()
            ->route('admin.talleres.index')
            ->with('success', 'Taller creado correctamente');
    }

    // =========================
    // EDITAR
    // =========================
    public function edit($id)
    {
        $taller = Taller::withTrashed()->findOrFail($id);

        return view('backend.admin.talleres.edit', compact('taller'));
    }

    // =========================
    // ACTUALIZAR
    // =========================
    public function update(Request $request, $id)
    {
        $taller = Taller::withTrashed()->findOrFail($id);

        $data = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'dias_horarios' => 'required|max:255',
            'precio' => 'required|numeric|min:0',
            'cupos_totales' => 'required|integer|min:1',
            'activo' => 'nullable',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $inscriptos = $taller->cupos_totales - $taller->cupos_disponibles;

        $data['cupos_disponibles'] = max(
            0,
            $data['cupos_totales'] - $inscriptos
        );

        $data['activo'] = $request->has('activo') ? 1 : 0;

        // =========================
        // IMAGEN UPDATE
        // =========================
        if ($request->hasFile('imagen')) {

            // borrar imagen anterior
            if ($taller->imagen && file_exists(public_path('img/talleres/' . $taller->imagen))) {
                unlink(public_path('img/talleres/' . $taller->imagen));
            }

            $file = $request->file('imagen');
            $nombre = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('img/talleres'), $nombre);

            $data['imagen'] = $nombre;
        }

        $taller->update($data);

        return redirect()
            ->route('admin.talleres.index')
            ->with('success', 'Taller actualizado correctamente');
    }

    // =========================
    // DELETE (SOFT DELETE)
    // =========================
    public function destroy($id)
    {
        $taller = Taller::findOrFail($id);
        $taller->delete();

        return back()->with('success', 'Taller eliminado');
    }

    // =========================
    // RESTORE
    // =========================
    public function restore($id)
    {
        $taller = Taller::withTrashed()->findOrFail($id);
        $taller->restore();

        return back()->with('success', 'Taller restaurado');
    }

    // =========================
    // INSCRIPTOS
    // =========================
    public function inscriptos($id)
    {
        $taller = Taller::with(['inscripciones.user'])
            ->withCount('inscripciones')
            ->findOrFail($id);

        return view('backend.admin.talleres.inscriptos', compact('taller'));
    }
}