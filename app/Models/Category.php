<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected  $fillable = [
        'parent_id',
        'title',
        'description',
        'image',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
    public function children() {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

}
