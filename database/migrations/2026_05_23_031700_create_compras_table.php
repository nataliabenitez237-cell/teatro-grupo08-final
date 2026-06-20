<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // =========================
    // CREAR TABLA COMPRAS
    // =========================
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {

            $table->id();

            // Usuario que realiza la compra
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // Método de pago (puede ser null si todavía no se selecciona)
            $table->unsignedBigInteger('metodo_pago_id')->nullable();

            // Relación con metodo_pagos (si se elimina, queda en null)
            $table->foreign('metodo_pago_id')
                ->references('id')
                ->on('metodo_pagos')
                ->onDelete('set null');

            // Total de la compra (valor final guardado)
            $table->decimal('total', 10, 2)->default(0);

            // Estado del proceso de compra
            $table->enum('estado', [
                'en_proceso', // carrito en curso
                'abonado',    // pago confirmado
                'cancelado'   // compra anulada
            ])->default('en_proceso');

            $table->timestamps();
        });
    }

    // =========================
    // BORRAR TABLA
    // =========================
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};