<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
