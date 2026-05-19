<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = ['user_id', 'follower_id', 'accepted_at'];
    
    protected $casts = [
        'accepted_at' => 'datetime',
    ];
    
    // Relación: Usuario que es seguido
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    // Relación: Usuario que sigue
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
}
