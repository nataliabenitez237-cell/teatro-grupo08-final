<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Carrito;

class AuthController extends Controller
{
    // =========================
    // FORM REGISTRO
    // =========================
    public function formularioRegistro()
    {
        return view('backend.usuarios.registro');
    }

    // =========================
    // REGISTRAR USUARIO
    // =========================
    public function registrar(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol_id' => 2,
        ]);

        if (!$user) {
            return redirect('/en-construccion')
                ->with('error', 'No se pudo crear el usuario');
        }

        Auth::login($user);

        return redirect('/cliente');
    }

    // =========================
    // FORM LOGIN
    // =========================
    public function formularioLogin()
    {
        return view('backend.usuarios.login');
    }

    // =========================
    // LOGIN + FUSIÓN CARRITO
    // =========================
    public function autenticar(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresá un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        if (Auth::attempt($credenciales)) {

            $request->session()->regenerate();

            $user = Auth::user();
            $sessionId = session()->getId();

            // =========================
            // FUSIÓN DE CARRITO
            // =========================
            $carritoSesion = Carrito::where('session_id', $sessionId)->get();

            foreach ($carritoSesion as $item) {

                $existente = Carrito::where('user_id', $user->id)
                    ->where('evento_id', $item->evento_id)
                    ->first();

                if ($existente) {

                    // sumar cantidades si ya existe
                    $existente->increment('cantidad', $item->cantidad);

                    $item->delete();

                } else {

                    // asignar al usuario logueado
                    $item->update([
                        'user_id' => $user->id,
                        'session_id' => null
                    ]);
                }
            }

            // =========================
            // REDIRECCIÓN POR ROL
            // =========================
            if ($user->rol_id == 1) {
                return redirect('/admin');
            }

            return redirect('/cliente');
        }

        return back()
            ->withInput()
            ->withErrors([
                'login' => 'Correo o contraseña incorrectos.'
            ]);
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}