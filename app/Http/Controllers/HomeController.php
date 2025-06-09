<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\PostController;

class HomeController extends Controller
{
    // public function getHome()
    // {
    //     $posts = Post::with('category','user')->where('habilitated',true)->orderBy('created_at', 'desc')->paginate(10);
    //     return view('home',compact('posts'));
    // }
    public function getHome()
    {
        $postController = new PostController();
        $data = $postController->indexFeed();

        return view('home', $data);
    }
}
