<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // =========================
    // CREAR TABLA METODO PAGOS
    // =========================
    public function up(): void
    {
        Schema::create('metodo_pagos', function (Blueprint $table) {

            $table->id();

            // Nombre del método de pago
            $table->string('nombre');

            // Activo o inactivo
            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    // =========================
    // ELIMINAR TABLA
    // =========================
    public function down(): void
    {
        Schema::dropIfExists('metodo_pagos');
    }
};