<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $with = ['categories'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
