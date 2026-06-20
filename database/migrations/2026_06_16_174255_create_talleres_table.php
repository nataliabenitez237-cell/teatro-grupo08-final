<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talleres', function (Blueprint $table) {

            $table->id();

            $table->string('nombre');

            $table->text('descripcion')->nullable();

            $table->string('dias_horarios');

            $table->decimal('precio', 10, 2);

            $table->integer('cupos_totales');

            $table->integer('cupos_disponibles');

            $table->string('imagen')->nullable();

            $table->boolean('activo')->default(true);

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talleres');
    }
};