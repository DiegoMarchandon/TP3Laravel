<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $user = User::first();
        
        Post::create([
            'title' => 'Se harían este tatuaje por USD $5.000 ?',
            'poster' => 'posters/5eioTRBGfZJLU1xXkCuP5IFIAzwXLz7MNbiF51eJ.png',
            'habilitated' => true,
            'category_id' => Category::findOrFail(2)->id,
            'content' => 'Hola buenos días, este es mi primer post',
            'user_id' => User::findOrFail(2)->id,
        ]);

        Post::create([
            'title' => 'Qué opción recomiendan',
            'poster' => 'posters/9oiz5O5eS5xMtO5mKjf2dBmZH1RuBnf3mDr9UczN.png',
            'habilitated' => false,
            'category_id' => Category::findOrFail(5)->id,
            'content' => 'No me decido entre la elección de una sesión.',
            'user_id' => User::findOrFail(3)->id,
        ]);

        Post::create([
            'title' => 'Los peores colores para tatuarse.',
            'poster' => 'posters/A5VFYgbIdtMH4uvQipH58FWk82loSZOU5hE5br2i.png',
            'habilitated' => true,
            'category_id' => Category::findOrFail(1)->id,
            'content' => 'Estos son los peores colores para elegir al momento de realizarse un tatuaje.',
            'user_id' => User::findOrFail(4)->id,
        ]);
    }
}
