<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
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
        // dd($post->toArray());
        // Return the view with the post data
        return view('posts.show', compact('post'));
    }

    public function store(Request $request)
    {
        // dd("en el store");
        // dd($request->all());
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
        // dd("pasó la validación");
        // $post = new Post();
        // $post->title = $request->title;
        // $post->content = $request->content;
        // $post->user_id = Auth::id();
        // $post->save();

        // Handle the image upload if a poster is provided
        $posterPath = null;
        if($request->hasFile('poster')){
            $posterPath = $request->file('poster')->store('posters','public');
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'poster' => $posterPath,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'habilitated' => true, // Assuming posts are enabled by default
        ]);
        dd("Post creado");
        return redirect()->route('home.index')->with('success', 'Post created successfully.');
    }

    public function toggleLike(Post $post)
    {
        // $user = auth()->user();
        $user = Auth::user();

        $existing = $post->likes()->where('user_id', $user->id)->first();
        if ($existing) {
            // If the user already liked the post, remove the like
            $existing->delete();
        } else {
            // Otherwise, create a new like
            $post->likes()->create(['user_id' => $user->id]);
        }
        return back();
    }

    public function makeComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|max:1000',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->save();

        return back()->with('success', 'Comment added successfully.');
    }
}
