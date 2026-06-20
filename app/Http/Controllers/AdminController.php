<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Consulta;
use App\Models\Compra;
use App\Models\Rol;

class AdminController extends Controller
{
    // =========================
    // DASHBOARD
    // =========================
    public function dashboard()
    {
        return view('backend.admin.dashboard');
    }

    // =========================
    // CONSULTAS (con buscador opcional)
    // =========================
    public function consultas(Request $request)
    {
        $query = Consulta::orderBy('id', 'desc');

        if ($request->filled('buscar')) {
            $busqueda = $request->buscar;

            $query->where('nombre', 'like', "%$busqueda%")
                  ->orWhere('email', 'like', "%$busqueda%");
        }

        $consultas = $query->get();

        return view('backend.admin.consultas.index', compact('consultas'));
    }

    // =========================
    // COMPRAS (filtros + buscador)
    // =========================
    public function comprasPendientes(Request $request)
    {
        $query = Compra::with([
            'user',
            'detalles.evento',
            'metodoPago'
        ]);

        // filtro estado compra
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // buscador
        if ($request->filled('buscar')) {
            $busqueda = $request->buscar;

            $query->where(function ($q) use ($busqueda) {
                $q->where('id', $busqueda)
                  ->orWhereHas('user', function ($u) use ($busqueda) {
                      $u->where('name', 'like', "%$busqueda%")
                        ->orWhere('apellido', 'like', "%$busqueda%")
                        ->orWhere('email', 'like', "%$busqueda%");
                  });
            });
        }

        $compras = $query->orderBy('id', 'desc')
                         ->paginate(10)
                         ->appends($request->all());

        return view('backend.admin.compras.index', compact('compras'));
    }

    public function showCompra($id)
    {
        $compra = Compra::with([
            'user',
            'detalles.evento',
            'metodoPago'
        ])->findOrFail($id);

        return view('backend.admin.compras.show', compact('compra'));
    }

    // =========================
    // USUARIOS (estado + buscador)
    // =========================
    public function usuarios(Request $request)
    {
        $estado = $request->estado;
        $buscar = $request->buscar;

        $query = User::with('rol')->withTrashed();

        // estado usuario
        if ($estado === 'activos') {
            $query->whereNull('deleted_at');
        }

        if ($estado === 'eliminados') {
            $query->onlyTrashed();
        }

        // buscador
        if (!empty($buscar)) {
            $query->where(function ($q) use ($buscar) {
                $q->where('name', 'like', "%$buscar%")
                  ->orWhere('apellido', 'like', "%$buscar%")
                  ->orWhere('email', 'like', "%$buscar%");
            });
        }

        $usuarios = $query->orderBy('id', 'desc')
                          ->paginate(10)
                          ->appends($request->all());

        return view('backend.admin.usuarios.index', compact('usuarios', 'estado'));
    }

    // =========================
    // EDIT USUARIO
    // =========================
    public function editUsuario($id)
    {
        $usuario = User::withTrashed()->findOrFail($id);
        $roles = Rol::all();

        return view('backend.admin.usuarios.edit', compact('usuario', 'roles'));
    }

    // =========================
    // UPDATE USUARIO
    // =========================
    public function updateUsuario(Request $request, $id)
    {
        $usuario = User::withTrashed()->findOrFail($id);

        $request->validate([
            'name'  => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
        ]);

        if ($usuario->rol_id == 1) {

            $usuario->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

        } else {

            $request->validate([
                'rol_id' => 'required|exists:roles,id',
            ]);

            $usuario->update([
                'name'   => $request->name,
                'email'  => $request->email,
                'rol_id' => $request->rol_id,
            ]);
        }

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    // =========================
    // DELETE USUARIO
    // =========================
    public function destroyUsuario($id)
    {
        $usuario = User::findOrFail($id);

        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'No podés darte de baja.');
        }

        if ($usuario->rol_id == 1) {
            return back()->with('error', 'No podés eliminar un administrador.');
        }

        $usuario->delete();

        return back()->with('success', 'Usuario dado de baja correctamente.');
    }

    // =========================
    // RESTORE
    // =========================
    public function restoreUsuario($id)
    {
        $usuario = User::withTrashed()->findOrFail($id);
        $usuario->restore();

        return back()->with('success', 'Usuario restaurado correctamente.');
    }

    // =========================
    // CREATE USUARIO
    // =========================
    public function createUsuario()
    {
        $roles = Rol::all();
        return view('backend.admin.usuarios.create', compact('roles'));
    }

    // =========================
    // STORE USUARIO
    // =========================
    public function storeUsuario(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'rol_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol_id' => $request->rol_id,
        ]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }
}