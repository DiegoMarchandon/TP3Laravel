<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;

/**
 * @property User $user
 * @property Category $category
 * @property \Illuminate\Database\Eloquent\Collection|Like[] $likes
 * @property \Illuminate\Database\Eloquent\Collection|Comment[] $comments
 */
class Post extends Model
{
    use HasFactory;

    // campos asignables masivamente
    protected $fillable = [
        'title',
        'poster',
        'habilitated',
        'content',
        'category_id',
        'user_id',
    ];

    public function likes()
{
    return $this->hasMany(Like::class);

}

public function user()
{
    return $this->belongsTo(User::class);
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
