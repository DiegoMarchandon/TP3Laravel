<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Obtener todas las notificaciones NO LEIDAS del usuario autenticado
    public function index()
    {
        $notifications = Auth::user()->notifications()
            ->with('sender')
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json($notifications);
    }

    // Obtener contador de notificaciones NO LEÍDAS
    public function unreadCount()
    {
        $count = Auth::user()->notifications()
            ->whereNull('read_at')
            ->count();
        
        return response()->json(['unread_count' => $count]);
    }

    // Marcar una notificación como leída
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        
        // Verificar que sea la notificación del usuario autenticado
        if ($notification->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification->update(['read_at' => now()]);
        
        return response()->json(['success' => true]);
    }

    // Marcar todas como leídas
    public function markAllAsRead()
    {
        Auth::user()->notifications()
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
        
        return response()->json(['success' => true]);
    }

    // Eliminar una notificación (rechazar solicitud)
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        
        // Verificar que sea la notificación del usuario autenticado
        if ($notification->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification->delete();
        
        return response()->json(['success' => true]);
    }
}