<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TallerController extends Controller
{
    // =========================
    // LISTADO PÚBLICO
    // =========================
    public function index()
    {
        $talleres = Taller::where('activo', 1)
            ->withCount('inscripciones')
            ->orderBy('nombre')
            ->paginate(9);

        return view('talleres', compact('talleres'));
    }

    // =========================
    // INSCRIPCIÓN
    // =========================
    public function inscribirse($id)
    {
        return DB::transaction(function () use ($id) {

            $taller = Taller::where('id', $id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($taller->cupos_disponibles <= 0) {
                return back()->with('error', 'No hay cupos disponibles');
            }

            $yaInscripto = Inscripcion::where('user_id', Auth::id())
                ->where('taller_id', $taller->id)
                ->exists();

            if ($yaInscripto) {
                return back()->with('error', 'Ya estás inscripto en este taller');
            }

            $taller->decrement('cupos_disponibles');

            Inscripcion::create([
                'user_id' => Auth::id(),
                'taller_id' => $taller->id,
            ]);

            return back()->with('success', 'Inscripción realizada correctamente');
        });
    }

    // =========================
    // MIS INSCRIPCIONES
    // =========================
    public function misInscripciones()
    {
        $inscripciones = Inscripcion::with('taller')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('cliente.mis-talleres', compact('inscripciones'));
    }

    // =========================
    // CANCELAR INSCRIPCIÓN
    // =========================
    public function cancelarInscripcion($id)
    {
        return DB::transaction(function () use ($id) {

            $inscripcion = Inscripcion::where('user_id', Auth::id())
                ->where('taller_id', $id)
                ->first();

            if (!$inscripcion) {
                return back()->with('error', 'No estás inscripto en este taller');
            }

            $inscripcion->delete();

            Taller::where('id', $id)
                ->increment('cupos_disponibles');

            return back()->with('success', 'Inscripción cancelada correctamente');
        });
    }
}