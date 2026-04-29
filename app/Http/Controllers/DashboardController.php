<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener los 5 posts más votados (con más likes)
        $topPosts = Post::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(5)
            ->get();

        // Obtener todas las reacciones disponibles
        $reactions = Reaction::all();

        return view('dashboard', [
            'topPosts' => $topPosts,
            'reactions' => $reactions,
        ]);
    }
}
