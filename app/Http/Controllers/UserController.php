<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/login')->with('success', 'Usuario registrado correctamente');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
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
                'password' => 'min:6'
            ]);

            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Perfil actualizado correctamente');
    }
}