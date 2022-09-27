<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected  $fillable = [
        'title',
        'description',
        'text',
        'hashtags',
        'image',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }

}
