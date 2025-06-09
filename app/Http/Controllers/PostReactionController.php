<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Support\Facades\Auth;

class PostReactionController extends Controller
{
    public function store(Request $request, Post $post, $reactionId)
{
    $userId = Auth::id();

    // Evitar duplicados: permitir una reacción por tipo por usuario
    $post->reactions()->detach($reactionId, ['user_id' => $userId]);

    // Añadir reacción
    $post->reactions()->attach($reactionId, ['user_id' => $userId]);

    return back();
}

}
