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
        // User::factory(10)->create();
        // $this->call(UserSeeder::class);

        
        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
    }
}
