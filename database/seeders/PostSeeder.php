<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        
        Post::create([
            'title' => 'First Post',
            'poster' => 'posters/5eioTRBGfZJLU1xXkCuP5IFIAzwXLz7MNbiF51eJ.png',
            'habilitated' => true,
            'content' => 'This is the content of the first post.',
            'user_id' => $user->id,
        ]);

        Post::create([
            'title' => 'Second Post',
            'poster' => 'posters/9oiz5O5eS5xMtO5mKjf2dBmZH1RuBnf3mDr9UczN.png',
            'habilitated' => false,
            'content' => 'This is the content of the second post.',
            'user_id' => $user->id,
        ]);

        Post::create([
            'title' => 'Third Post',
            'poster' => 'posters/A5VFYgbIdtMH4uvQipH58FWk82loSZOU5hE5br2i.png',
            'habilitated' => true,
            'content' => 'This is the content of the third post.',
            'user_id' => $user->id,
        ]);
    }
}
