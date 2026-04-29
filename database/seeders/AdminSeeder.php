<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Verifica si el admin ya existe
        $admin = User::where('email', 'admin@myblog.com')->first();

        if (!$admin) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@myblog.com',
                'password' => Hash::make('admin123'), // Cambialo después
                'role' => 'admin',
                'habilitated' => true,
                'email_verified_at' => now(),
            ]);

            echo "✅ Usuario admin creado exitosamente!\n";
            echo "Email: admin@myblog.com\n";
            echo "Contraseña: admin123\n";
            echo "⚠️  IMPORTANTE: Cambia la contraseña después de first login!\n";
        } else {
            echo "⚠️  El usuario admin ya existe.\n";
        }
    }
}
