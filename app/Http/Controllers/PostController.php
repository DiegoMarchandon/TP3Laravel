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

        // $comment = new Comment();
        // $comment->content = $request->content;
        // $comment->user_id = Auth::id();
        // $comment->post_id = $post->id;
        // $comment->save();

        $post->comments()->create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            // 'post_id' => $post->id,
        ]);

        return back()->with('success', 'Comment added successfully.');
    }

    /* public function filterByCategory(Request $request)
    {
        $id = $request->input('id');
     
        if($id){
            $category = Category::findOrFail($id);
            // Get all posts that belong to the specified category
            $posts = Post::where('category_id', $category->id)->with('user')->get();
        } else {
            // If no category is specified, get all posts
            $posts = Post::with('user')->get();
            $category = null; // No category selected
        }

        return view('posts.filter', compact('posts', 'category'));
    } */

    public function filterByCategory(Request $request)
    {
        dd("Estoy en el método filterByCategory");
        /* $id = $request->input('id'); // Obtiene el parámetro 'id' del query string

        if ($id) {
            $category = Category::find($id); // Busca la categoría por ID
            if (!$category) {
                return redirect()->route('home.index')->with('error', 'Categoría no encontrada.');
            }
            $posts = Post::where('category_id', $id)->with('user')->get();
        } else {
            $posts = Post::with('user')->get(); // Si no hay categoría seleccionada, muestra todos los posts
            $category = null; // No hay categoría seleccionada
        }

        return view('posts.filter', compact('posts', 'category')); */
    }

    /* public function edit(Post $post)
    {
        // Ensure the authenticated user is the owner of the post
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('home.index')->with('error', 'Unauthorized action.');
        }

        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    } */
}
