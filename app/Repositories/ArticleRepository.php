<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
    public function create(array $data): Article
    {
        return Article::create($data);
    }

    public function update(Article $article, array $data): Article
    {
        $article->fill($data)->save();
        return $article;
    }
}