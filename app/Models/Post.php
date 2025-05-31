<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    // campos asignables masivamente
    protected $fillable = [
        'title',
        'poster',
        'habilitated',
        'content',
    ];

    public function likes()
{
    return $this->hasMany(Like::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}

}
