<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::all();
        // dd($users);
        return view('admin.users', compact('users'));
    }
    public function getPosts()
    {
        $posts = Post::all();
        // dd($posts);
        return view('admin.posts', compact('posts'));
    }

    public function getAdminView()
    {
        $users = User::all();
        $posts = Post::all();
        return view('admin.index', compact('users', 'posts'));
    }

    public function changeUserState($userID)
    {
        $user = User::findOrFail($userID);
        $user->habilitated = !$user->habilitated; // Pongo el estado opuesto
        $user->save();
        return redirect()->back()->with('success', $user->habilitated);
    }
}
