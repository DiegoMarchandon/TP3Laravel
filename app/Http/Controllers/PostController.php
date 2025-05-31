<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // $post = new Post();
        // $post->title = $request->title;
        // $post->content = $request->content;
        // $post->user_id = Auth::id();
        // $post->save();

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'poster' => $request->poster,
            'user_id' => Auth::id(),
            'habilitated' => true, // Assuming posts are enabled by default
        ]);

        return redirect()->route('home.index')->with('success', 'Post created successfully.');
    }
}
