<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;

class ConsultaController extends Controller
{
    // Mostrar el formulario de consultas
    public function showForm()
    {
        return view('consultas');
    }

    // Procesar el envío de la consulta
    public function enviar(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'mensaje' => 'required|string|min:10',
        ]);

        // Guardar en la base de datos
        Consulta::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'mensaje' => $request->mensaje,
            'leido' => 0, // por defecto no leído
        ]);

        // Redirigir con mensaje de éxito
        return redirect()
            ->route('consultas.form')
            ->with('success', '¡Mensaje enviado con éxito! Te responderemos a la brevedad.');
    }
}