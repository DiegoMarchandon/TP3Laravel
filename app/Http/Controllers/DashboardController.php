<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Posts a los que el usuario le ha dado like:
        // Usamos pluck() para extraer solamente el objeto post.
            // Sin pluck (Colección de likes Obj): [Like{id:1, post_id:5}, Like{id:2, post_id:8}, ...]
        $likedPosts = Auth::user()->likes()->with('post')->get()->pluck('post');

        // Posts donde el usuario comentó (unique() porque un usuario puede comentar el mismo post varias veces):
            // Con pluck (Colección de posts Obj): [Post{id:5, title:'...'}, Post{id:8, title:'...'}, ...]
        $commentedPosts = Auth::user()->comments()->with('post')->get()->pluck('post')->unique();

        // Posts que el usuario marcó como guardados(usamos la reacción 'saved')
        $savedPosts = Post::whereHas('reactions', function($query) {
            $query->where('reaction.nombre', 'saved')
                  ->whereRaw('post_reaction.user_id = ?', [Auth::id()]);
        })->get();

        // Estadísticas del usuario
        $userStats = [
            'joinDate' => Auth::user()->created_at,
            'postsCount' => Auth::user()->posts()->count(),
            // Necesitamos contar todos los likes recibidos en los posts del usuario. La lógica es:
            // - Traemos todos los posts del usuario.
            // - Contamos la cantidad de likes de esos posts.
            'likesReceived' => Auth::user()->posts()->with('likes')->get()->sum(fn($post)=>$post->likes->count()),
        ];

        // Datos que pasamos a la vista
        return view('dashboard', [
            'topPosts' => $topPosts,
            'likedPosts' => $likedPosts,
            'commentedPosts' => $commentedPosts,
            'savedPosts' => $savedPosts,
            'reactions' => $reactions,
            'userStats' => $userStats,
        ]);
    }
}
