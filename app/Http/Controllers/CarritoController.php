<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use App\Models\Carrito;
use App\Models\Evento;
use App\Models\Taller;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\MetodoPago;
use App\Models\Inscripcion;

use App\Mail\CompraConfirmacion;

class CarritoController extends Controller
{
    // =========================
    // AGREGAR AL CARRITO (TALLERES)
    // =========================
    public function agregar(Request $request, $id)
    {
        $taller = Taller::findOrFail($id);
        $userId = Auth::id();

        if ($taller->cupos_disponibles <= 0) {
            return back()->with('error', 'No hay cupos disponibles');
        }

        $carrito = Carrito::where('user_id', $userId)
            ->where('taller_id', $id)
            ->first();

        if ($carrito) {

            if ($carrito->cantidad + 1 > $taller->cupos_disponibles) {
                return back()->with('error', 'No hay cupos suficientes');
            }

            $carrito->increment('cantidad');

        } else {

            Carrito::create([
                'user_id' => $userId,
                'taller_id' => $id,
                'cantidad' => 1,
                'expires_at' => now()->addMinutes(15),
            ]);
        }

        $taller->decrement('cupos_disponibles');

        return redirect()->route('carrito.ver')->with('success', 'Taller agregado al carrito');
    }


    public function agregarEvento(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);
        $userId = Auth::id();

        if ($evento->stock_disponible <= 0) {
            return back()->with('error', 'No hay entradas disponibles');
        }

        $carrito = Carrito::where('user_id', $userId)
            ->where('evento_id', $id)
            ->first();

        if ($carrito) {
            if ($carrito->cantidad + 1 > $evento->stock_disponible) {
                return back()->with('error', 'No hay entradas suficientes');
            }
            $carrito->increment('cantidad');
        } else {
            Carrito::create([
                'user_id' => $userId,
                'evento_id' => $id,
                'cantidad' => 1,
                'expires_at' => now()->addMinutes(15),
            ]);
        }

        $evento->decrement('stock_disponible');

        return redirect()->route('carrito.ver')->with('success', 'Evento agregado al carrito');
    }

    // =========================
    // VER CARRITO
    // =========================
    public function verCarrito()
    {
        $carrito = Carrito::where('user_id', Auth::id())
            ->with('evento', 'taller')
            ->get();

        $subtotal = 0;
        foreach ($carrito as $item) {
            if ($item->evento_id) {
                $subtotal += $item->cantidad * $item->evento->precio;
            } elseif ($item->taller_id) {
                $subtotal += $item->cantidad * $item->taller->precio;
            }
        }

        $comision = 2000;
        $total = $subtotal + $comision;

        $metodosPago = MetodoPago::where('activo', 1)->get();

        return view('backend.carrito', compact(
            'carrito',
            'subtotal',
            'comision',
            'total',
            'metodosPago'
        ));
    }

    // =========================
    // ACTUALIZAR CANTIDAD
    // =========================
    public function actualizarCantidad(Request $request, $id)
    {
        $item = Carrito::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('taller', 'evento')
            ->firstOrFail();

        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        $nuevaCantidad = $request->cantidad;
        $diferencia = $nuevaCantidad - $item->cantidad;

        if ($item->taller_id) {
            // ES UN TALLER
            $taller = $item->taller;
            
            if ($nuevaCantidad > $taller->cupos_disponibles + $item->cantidad) {
                return back()->with('error', 'No hay cupos suficientes');
            }
            
            $taller->decrement('cupos_disponibles', $diferencia);
            
        } elseif ($item->evento_id) {
            // ES UN EVENTO
            $evento = $item->evento;
            
            if ($nuevaCantidad > $evento->stock_disponible + $item->cantidad) {
                return back()->with('error', 'No hay stock suficiente');
            }
            
            $evento->decrement('stock_disponible', $diferencia);
        }

        $item->update([
            'cantidad' => $nuevaCantidad
        ]);

        return back()->with('success', 'Cantidad actualizada');
    }

    // =========================
    // ELIMINAR ITEM
    // =========================
    public function eliminar($id)
    {
        $item = Carrito::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('taller', 'evento')
            ->first();

        if ($item) {
            if ($item->taller_id) {
                $item->taller->increment('cupos_disponibles', $item->cantidad);
            } elseif ($item->evento_id) {
                $item->evento->increment('stock_disponible', $item->cantidad);
            }
            $item->delete();
        }

        return back()->with('success', 'Item eliminado del carrito');
    }

    // =========================
    // VACIAR CARRITO
    // =========================
    public function vaciar()
    {
        $carrito = Carrito::where('user_id', Auth::id())
            ->with('taller', 'evento')
            ->get();

        foreach ($carrito as $item) {
            if ($item->taller_id) {
                $item->taller->increment('cupos_disponibles', $item->cantidad);
            } elseif ($item->evento_id) {
                $item->evento->increment('stock_disponible', $item->cantidad);
            }
        }

        Carrito::where('user_id', Auth::id())->delete();

        return back()->with('success', 'Carrito vaciado');
    }

    // =========================
    // FINALIZAR COMPRA
    // =========================
    public function finalizarCompra(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'metodo_pago_id' => 'required|exists:metodo_pagos,id'
        ]);

        return DB::transaction(function () use ($user, $request) {

            $carrito = Carrito::where('user_id', $user->id)
                ->with('evento', 'taller')
                ->lockForUpdate()
                ->get();

            if ($carrito->isEmpty()) {
                return back()->with('error', 'El carrito está vacío');
            }

            $subtotal = 0;
            foreach ($carrito as $item) {
                if ($item->evento_id) {
                    // Verificar stock de evento
                    if ($item->cantidad > $item->evento->stock_disponible) {
                        return back()->with('error', 'Stock insuficiente para: ' . $item->evento->nombre);
                    }
                    $subtotal += $item->cantidad * $item->evento->precio;
                } elseif ($item->taller_id) {
                    // Verificar cupos de taller
                    if ($item->cantidad > $item->taller->cupos_disponibles) {
                        return back()->with('error', 'Cupos insuficientes para: ' . $item->taller->nombre);
                    }
                    $subtotal += $item->cantidad * $item->taller->precio;
                }
            }

            $total = $subtotal + 2000;

            $compra = Compra::create([
                'user_id' => $user->id,
                'total' => $total,
                'estado' => 'en_proceso',
                'metodo_pago_id' => $request->metodo_pago_id,
            ]);

            foreach ($carrito as $item) {
                // Crear detalle de compra
                if ($item->evento_id) {
                    $evento = $item->evento;
                    $evento->decrement('stock_disponible', $item->cantidad);
                    
                    DetalleCompra::create([
                        'compra_id' => $compra->id,
                        'evento_id' => $item->evento_id,
                        'taller_id' => null,
                        'cantidad' => $item->cantidad,
                        'precio_unitario' => $evento->precio,
                        'subtotal' => $item->cantidad * $evento->precio,
                    ]);
                } elseif ($item->taller_id) {
                    $taller = $item->taller;
                    $taller->decrement('cupos_disponibles', $item->cantidad);
                    
                    DetalleCompra::create([
                        'compra_id' => $compra->id,
                        'evento_id' => null,
                        'taller_id' => $item->taller_id,
                        'cantidad' => $item->cantidad,
                        'precio_unitario' => $taller->precio,
                        'subtotal' => $item->cantidad * $taller->precio,
                    ]);

                    // Crear inscripción al taller
                    $inscripcionExistente = Inscripcion::where('user_id', $user->id)
                        ->where('taller_id', $item->taller_id)
                        ->first();

                    if (!$inscripcionExistente) {
                        Inscripcion::create([
                            'user_id' => $user->id,
                            'taller_id' => $item->taller_id,
                        ]);
                    }
                }
            }

            Carrito::where('user_id', $user->id)->delete();

            Mail::to($user->email)->send(new CompraConfirmacion($compra));

            return redirect('/cliente')
                ->with('success', 'Compra realizada correctamente. Total: $' .
                    number_format($total, 0, ',', '.'));
        });
    }
}