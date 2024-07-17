<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = ['name', 'slug', 'description'];
    protected $with = ['articles'];

    protected function slugKey(): string
    {
        return 'slug';
    }

    protected function sluggable(): string
    {
        return $this->name;
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function orderedArticles($orderBy = 'created_at', $order = 'desc')
    {
        return $this->articles()->orderBy($orderBy, $order);
    }
}
