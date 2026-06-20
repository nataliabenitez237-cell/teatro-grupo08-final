<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        Rol::updateOrCreate(
            ['id' => 1],
            [
                'nombre' => 'admin',
                'descripcion' => 'Administrador del sistema'
            ]
        );

        Rol::updateOrCreate(
            ['id' => 2],
            [
                'nombre' => 'cliente',
                'descripcion' => 'Cliente del teatro'
            ]
        );
    }
}