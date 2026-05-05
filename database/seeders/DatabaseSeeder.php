<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// seeder principal de laravel. Punto de entrada para ejecutar otros seeders. 
    // sirve para tener cada seeder en un archivo separado y poder ejecutarlos de forma individual o todos juntos.
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear algunos usuarios aleatorios para testing
        User::factory(5)->create();
        
        // Seeders necesarios
        $this->call([
            ReaccionesSeeder::class,
            CategorySeeder::class,      // ← Categorías (originales)
            PostSeeder::class,
            TattooPostSeeder::class,
            AdminSeeder::class,         // ← Usuario admin
        ]);

    }
}
