<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evento;

class EventosSeeder extends Seeder
{
    public function run(): void
    {
        Evento::create([
            'nombre' => 'La Traviata - Ópera',
            'descripcion' => 'Una de las óperas más famosas de Giuseppe Verdi.',
            'fecha' => '2025-05-15',
            'hora' => '20:00:00',
            'precio' => 25000,
            'stock_total' => 110,
            'stock_disponible' => 110,
            'imagen' => 'traviata.jpg',
            'activo' => true,
        ]);

        Evento::create([
            'nombre' => 'Romeo y Julieta - Ballet',
            'descripcion' => 'El clásico de Shakespeare en una producción única.',
            'fecha' => '2025-05-20',
            'hora' => '20:00:00',
            'precio' => 30000,
            'stock_total' => 110,
            'stock_disponible' => 110,
            'imagen' => 'romeo.jpg',
            'activo' => true,
        ]);

        Evento::create([
            'nombre' => 'Concierto Sinfónico',
            'descripcion' => 'Orquesta Filarmónica de la Ciudad.',
            'fecha' => '2025-05-25',
            'hora' => '20:00:00',
            'precio' => 20000,
            'stock_total' => 110,
            'stock_disponible' => 110,
            'imagen' => 'sinfonico.jpg',
            'activo' => true,
        ]);
    }
}