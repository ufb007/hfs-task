<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getWithArticles($id)
    {
        return Category::find($id)->get();
    }
}