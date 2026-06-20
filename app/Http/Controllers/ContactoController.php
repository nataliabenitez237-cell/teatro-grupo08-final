<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function enviar(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'mensaje' => 'required',
        ]);

        // Datos del formulario
        $data = [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'mensaje' => $request->mensaje,
        ];

        // Enviar email
        Mail::send('emails.contacto', $data, function ($message) use ($data) {
            $message->to('teatrodelaciudad788@gmail.com')
                    ->subject('Nuevo mensaje de contacto');
        });

        return redirect('/contacto')->with('success', 'Mensaje enviado correctamente');
    }
}