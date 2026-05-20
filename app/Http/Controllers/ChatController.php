<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Obtener todos los chats aceptados del usuario
    public function index()
    {
        $userId = Auth::id();
        
        $chats = Chat::where('accepted_at', '!=', null)
            ->where(function ($query) use ($userId) {
                $query->where('user_id_1', $userId)
                    ->orWhere('user_id_2', $userId);
            })
            ->with(['user1', 'user2'])
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($chat) use ($userId) {
                $otherUser = $chat->user_id_1 === $userId ? $chat->user2 : $chat->user1;
                $lastMessage = $chat->messages()->latest()->first();
                
                return [
                    'id' => $chat->id,
                    'otherUser' => $otherUser,
                    'lastMessage' => $lastMessage?->content ? substr($lastMessage->content, 0, 30) . (strlen($lastMessage->content) > 30 ? '...' : '') : null,
                    'created_at' => $chat->created_at,
                ];
            });
        
        return response()->json($chats);
    }

    // Obtener mensajes de un chat específico
    public function messages($chatId)
    {
        $chat = Chat::findOrFail($chatId);
        $userId = Auth::id();
        
        // Verificar que el usuario sea parte del chat
        if ($chat->user_id_1 !== $userId && $chat->user_id_2 !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messages = Message::where('chat_id', $chatId)
            ->orderBy('created_at', 'asc')
            ->get();
        
        return response()->json($messages);
    }

    // Enviar un mensaje
    public function storeMessage($chatId)
    {
        $chat = Chat::findOrFail($chatId);
        $userId = Auth::id();
        
        // Verificar que el usuario sea parte del chat
        if ($chat->user_id_1 !== $userId && $chat->user_id_2 !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $content = request()->input('content');
        if (!$content || !trim($content)) {
            return response()->json(['error' => 'Mensaje vacío'], 422);
        }

        $receiverId = $chat->user_id_1 === $userId ? $chat->user_id_2 : $chat->user_id_1;

        $message = Message::create([
            'chat_id' => $chatId,
            'sender_id' => $userId,
            'receiver_id' => $receiverId,
            'content' => $content,
        ]);

        $chat->touch();

        return response()->json($message);
    }
}
