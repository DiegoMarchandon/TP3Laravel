<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $table = 'reaction';

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_reaction')
            ->withPivot('user_id')
            ->withTimestamps();
    }
}
