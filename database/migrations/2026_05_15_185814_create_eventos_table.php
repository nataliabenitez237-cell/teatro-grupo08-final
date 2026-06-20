<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // =========================
    // CREAR TABLA EVENTOS
    // =========================
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {

            // ID principal
            $table->id();

            // Nombre del evento
            $table->string('nombre');

            // Descripción opcional del evento
            $table->text('descripcion')->nullable();

            // Fecha del evento
            $table->date('fecha');

            // Hora del evento
            $table->time('hora');

            // Precio del evento
            $table->decimal('precio', 10, 2);

            // Stock total inicial
            $table->integer('stock_total');

            // Stock disponible para venta
            $table->integer('stock_disponible');

            // Imagen del evento (opcional)
            $table->string('imagen')->nullable();

            // Si el evento está activo o no
            $table->boolean('activo')->default(true);

            // Fechas de creación y actualización
            $table->timestamps();

            // Soft delete (eliminación lógica)
            $table->softDeletes();
        });
    }

    // =========================
    // ELIMINAR TABLA
    // =========================
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};