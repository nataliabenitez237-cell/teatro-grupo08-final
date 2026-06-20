<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carrito', function (Blueprint $table) {

            $table->unsignedBigInteger('taller_id')->nullable()->after('user_id');

            $table->foreign('taller_id')
                ->references('id')
                ->on('talleres')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('carrito', function (Blueprint $table) {

            $table->dropForeign(['taller_id']);
            $table->dropColumn('taller_id');
        });
    }
};
