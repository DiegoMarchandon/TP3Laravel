<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['user_id_1', 'user_id_2', 'accepted_at'];
    
    protected $casts = [
        'accepted_at' => 'datetime',
    ];
    
    // Relación: Primer usuario de la conversación
    public function user1()
    {
        return $this->belongsTo(User::class, 'user_id_1');
    }
    
    // Relación: Segundo usuario de la conversación
    public function user2()
    {
        return $this->belongsTo(User::class, 'user_id_2');
    }
    
    // Relación: Mensajes de esta conversación
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
