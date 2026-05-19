<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'chat_id', 'content', 'read_at'];
    
    protected $casts = [
        'read_at' => 'datetime',
    ];
    
    // Relación: Quién envió el mensaje
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    
    // Relación: Quién recibe el mensaje
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    
    // Relación: Chat al que pertenece el mensaje
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
