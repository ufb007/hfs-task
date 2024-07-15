<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = ['title', 'slug', 'content'];
    protected $with = ['comments', 'votes'];

    protected function slugKey(): string
    {
        return 'slug';
    }

    protected function sluggable(): string
    {
        return $this->title;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
