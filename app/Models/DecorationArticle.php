<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DecorationArticle extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'author_name',
        'reading_time',
        'tags'
    ];

    protected $casts = [
        'tags' => 'array'
    ];
} 