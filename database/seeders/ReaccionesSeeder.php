<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReaccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reaction')->insert([
            [
                'nombre' => 'laugh',
                'imagen_url' => 'reacciones/laugh.png',
            ],
            [
                'nombre' => 'amazed',
                'imagen_url' => 'reacciones/amazed.png',
            ],
            [
                'nombre' => 'angry',
                'imagen_url' => 'reacciones/angry.png',
            ],
            [
                'nombre' => 'dislike',
                'imagen_url' => 'reacciones/dislike.png',
            ],
            [
                'nombre' => 'sad',
                'imagen_url' => 'reacciones/sad.png',
            ],
            [
                'nombre' => 'smile',
                'imagen_url' => 'reacciones/smile.png',
            ],
            [
                'nombre' => 'think',
                'imagen_url' => 'reacciones/think.png',
            ],
        ]);
    }
}
