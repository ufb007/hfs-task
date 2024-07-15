<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = ['title', 'content'];

    protected function slugKey(): string
    {
        return 'slug';
    }

    protected function sluggable(): string
    {
        return $this->title;
    }

    public function caregory()
    {
        return $this->belongsTo(Category::class);
    }
}
