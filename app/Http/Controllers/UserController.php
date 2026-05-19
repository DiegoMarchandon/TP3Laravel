<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Follower;
use App\Models\Chat;
use App\Models\Notification;
use App\Events\FollowRequested;
use App\Events\ChatRequested;
use Illuminate\Support\Facades\Auth;
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

    public function follow(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'No puedes seguirte a ti mismo');
        }

        FollowRequested::dispatch($user, Auth::user());
        
        return back()->with('success', 'Solicitud de seguimiento enviada');
    }

    public function chat(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'No puedes chatear contigo mismo');
        }

        ChatRequested::dispatch($user, Auth::user());
        
        return back()->with('success', 'Solicitud de chat enviada');
    }   

    public function acceptFollow(Notification $notification)
    {
        if ($notification->type !== 'follow_request') {
            return back()->with('error', 'Notificación inválida');
        }

        Follower::updateOrCreate([
            'user_id' => $notification->user_id,
            'follower_id' => $notification->sender_id,
        ], [
            'accepted_at' => now()
        ]);

        $notification->update(['read_at' => now()]);
        
        return back()->with('success', 'Ahora tienes un nuevo seguidor');
    }

    // Aceptar solicitud de chat
    public function acceptChat(Notification $notification)
    {
        if ($notification->type !== 'chat_request') {
            return back()->with('error', 'Notificación inválida');
        }

        Chat::firstOrCreate([
            'user_id_1' => min($notification->user_id, $notification->sender_id),
            'user_id_2' => max($notification->user_id, $notification->sender_id),
        ], [
            'accepted_at' => now()
        ]);

        $notification->update(['read_at' => now()]);
        
        return back()->with('success', 'Chat aceptado');
    }
}
