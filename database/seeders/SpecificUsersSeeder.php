<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SpecificUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Juan',
                'email' => 'juan@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'storage/avatars/avatar1.png'

            ],
            [
                'name' => 'Pedro',
                'email' => 'pedro@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'storage/avatars/avatar2.png'

            ],
            [
                'name' => 'Ana',
                'email' => 'ana@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'storage/avatars/avatar3.png'

            ],
            [
                'name' => 'Jose',
                'email' => 'jose@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'storage/avatars/avatar4.png'

            ],
            [
                'name' => 'Maria',
                'email' => 'maria@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'storage/avatars/avatar5.png'

            ]
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
