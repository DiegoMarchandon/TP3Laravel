<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'First Post',
            'poster' => 'https://example.com/poster1.jpg',
            'habilitated' => true,
            'content' => 'This is the content of the first post.',
        ]);

        Post::create([
            'title' => 'Second Post',
            'poster' => 'https://example.com/poster2.jpg',
            'habilitated' => false,
            'content' => 'This is the content of the second post.',
        ]);

        Post::create([
            'title' => 'Third Post',
            'poster' => 'https://example.com/poster3.jpg',
            'habilitated' => true,
            'content' => 'This is the content of the third post.',
        ]);
    }
}
