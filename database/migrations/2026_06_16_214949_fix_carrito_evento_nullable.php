<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carrito', function (Blueprint $table) {

            // evento_id deja de ser obligatorio (evita error 1364)
            if (Schema::hasColumn('carrito', 'evento_id')) {
                $table->unsignedBigInteger('evento_id')->nullable()->change();
            }

            // asegurar taller_id
            if (!Schema::hasColumn('carrito', 'taller_id')) {
                $table->unsignedBigInteger('taller_id')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('carrito', function (Blueprint $table) {

            if (Schema::hasColumn('carrito', 'evento_id')) {
                $table->unsignedBigInteger('evento_id')->nullable(false)->change();
            }

            if (Schema::hasColumn('carrito', 'taller_id')) {
                $table->dropColumn('taller_id');
            }
        });
    }
};