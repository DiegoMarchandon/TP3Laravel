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
                'imagen_url' => 'storage/reacciones/laugh.png',
            ],
            [
                'nombre' => 'amazed',
                'imagen_url' => 'storage/reacciones/amazed.png',
            ],
            [
                'nombre' => 'angry',
                'imagen_url' => 'storage/reacciones/angry.png',
            ],
            [
                'nombre' => 'dislike',
                'imagen_url' => 'storage/reacciones/dislike.png',
            ],
            [
                'nombre' => 'sad',
                'imagen_url' => 'storage/reacciones/sad.png',
            ],
            [
                'nombre' => 'smile',
                'imagen_url' => 'storage/reacciones/smile.png',
            ],
            [
                'nombre' => 'think',
                'imagen_url' => 'storage/reacciones/think.png',
            ],
        ]);
    }
}
