<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getWithArticlesBySlug($slug)
    {
        return Category::where('slug', $slug)->first();
    }
}