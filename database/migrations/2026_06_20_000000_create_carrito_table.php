<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id();

            // Usuario logueado (puede ser null si no inició sesión)
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            // Para usuarios sin login
            $table->string('session_id')->nullable();

            // Evento agregado al carrito
            $table->foreignId('evento_id')
                ->constrained('eventos')
                ->onDelete('cascade');

            // Cantidad de entradas reservadas
            $table->integer('cantidad')->default(1);

            // =========================
            // EXPIRACIÓN DE RESERVA
            // =========================
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito');
    }
};