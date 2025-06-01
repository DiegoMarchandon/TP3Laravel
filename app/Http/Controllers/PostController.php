<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function create()
    {
        $categories = Category::all();
        return view('posts.create',compact('categories'));
    }

    public function show(Post $post)
    {
        // Load the category and user relationship
        $post->load('category', 'user');

        // Return the view with the post data
        return view('posts.show', compact('post'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'poster' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
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
            'category_id' => $request->category_id,
            'habilitated' => true, // Assuming posts are enabled by default
        ]);

        return redirect()->route('home.index')->with('success', 'Post created successfully.');
    }
}
