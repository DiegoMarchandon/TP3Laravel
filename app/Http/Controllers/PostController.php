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
        $posterPath = null; // para imagen local
        $posterUrl = null;
        // dd("en el store");
        // dd($request->all());
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'poster_url' => 'nullable|url|max:255', // Validación para URL de poster
            'category_id' => 'required|exists:categories,id',
        ]);
        // dd("pasó la validación");
        // $post = new Post();
        // $post->title = $request->title;
        // $post->content = $request->content;
        // $post->user_id = Auth::id();
        // $post->save();

        if($request->hasFile('poster')){
            $posterPath = $request->file('poster')->store('posters','public');
        }elseif($request->poster_url){
            // If a URL is provided, you might want to validate it or handle it differently
            $posterUrl = $request->poster_url;
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'poster' => $posterPath,
            'poster_url' => $posterUrl, 
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'habilitated' => true, // Assuming posts are enabled by default
        ]);
        // dd("Post creado");
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

        if (!Auth::check()) {
            return redirect()->route('register')
                ->with('error', 'Debes registrarte para comentar.');
        }

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
            'post_id' => $post->id,
        ]);

        return back()->with('success', 'Comment added successfully.');
    }

    public function filterByCategory(Request $request)
    {
        // $categoryId = $request->all(); // o $request->id

        // Para debug visual
        // dd($request->input('id'));
        // dd($request);
        // dd("Estoy en el método filterByCategory");
        // return "estoy en el método filterByCategory";
        $id = $request->input('id'); // Obtiene el parámetro 'id' del query string

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
        
        return view('home', compact('posts', 'category'));
    }
    
    public function orderPostsBy(Request $request)
    {
        $metric = $request->input('metric', 'likes'); // por defecto likes
        $order = $request->input('order', 'desc'); // por defecto descendente

        if (!in_array($order, ['asc', 'desc']) || !in_array($metric, ['likes', 'comments'])) {
            return redirect()->route('home.index')->with('error', 'Parámetros inválidos.');
        }

        $query = Post::query()->with('user');

        if ($metric === 'likes') {
            $query->withCount('likes')->orderBy('likes_count', $order);
        } elseif ($metric === 'comments') {
            $query->withCount('comments')->orderBy('comments_count', $order);
        }

        $posts = $query->get();

        return view('home', [
            'posts' => $posts,
            'category' => $category ?? null,
            'orderedBy' => $metric,
            'orderDirection' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified post.
     */
    public function editPost(Post $post)
    {
        // Ensure the authenticated user is the owner of the post
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('home.index')->with('error', 'Unauthorized action.');
        }

        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified post in storage.
     */
    public function updatePost(Request $request, Post $post)
    {
        // Ensure the authenticated user is the owner of the post
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('home.index')->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'poster_url' => 'nullable|url|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Handle the image upload if a new poster is provided
        $posterPath = $post->poster; // Keep the existing poster path
        $posterUrl = $post->poster_url; // Keep the existing poster URL
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $posterUrl = null;
        }
        elseif ($request->filled('poster_url')) {
            // If a URL is provided, you might want to validate it or handle it differently
            $posterUrl = $request->poster_url;
            $posterPath = null;
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'poster' => $posterPath,
            'poster_url' => $posterUrl, 
            'user_id' => Auth::id(), 
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('home.index', ['post' => $post])->with('success', 'Post updated successfully.');
    }

    /**
     * Disable the specified post.
     */
    public function disablePost($id)
    {
        $post = Post::findOrFail($id); // Find the post by ID or fail if not found

        // Ensure the authenticated user is the owner of the post or an admin
        if ((Auth::id() !== $post->user_id) && Auth::user()->role !== 'admin') {
            return redirect()->route('home.index')->with('error', 'Unauthorized action.');
        }

        $post->habilitated = 0; // Disable the post
        $post->save(); // Save the changes

        return redirect()->route('home.index')->with('success', 'Post disabled successfully.');
    }

    public function indexFeed()
    {
        // Cargamos los posts con sus relaciones
        $posts = Post::with(['user', 'category', 'likes', 'comments', 'reactions'])->latest()->get();

        // Todas las reacciones disponibles (para mostrar los emojis)
        $reactions = \App\Models\Reaction::all();

        // Pasamos ambos datos a la vista
        // return view('home', compact('posts', 'reactions'));
        return compact('posts', 'reactions');
    }

}
