<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
    public function findOne($slug): Article
    {
        return Article::where('slug', $slug)->first();
    }
}