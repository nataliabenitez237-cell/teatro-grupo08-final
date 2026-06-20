<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // =========================
    // CREAR DETALLE DE COMPRAS
    // =========================
    public function up(): void
    {
        Schema::create('detalle_compras', function (Blueprint $table) {

            $table->id();

            // Relación con la compra principal
            $table->foreignId('compra_id')
                ->constrained('compras')
                ->onDelete('cascade');

            // Evento o producto comprado
            $table->foreignId('evento_id')
                ->constrained('eventos')
                ->onDelete('cascade');

            // Cantidad comprada
            $table->integer('cantidad');

            // Precio en el momento de la compra
            $table->decimal('precio_unitario', 10, 2);

            // Subtotal de esta línea
            $table->decimal('subtotal', 10, 2);

            $table->timestamps();
        });
    }

    // =========================
    // BORRAR TABLA
    // =========================
    public function down(): void
    {
        Schema::dropIfExists('detalle_compras');
    }
};