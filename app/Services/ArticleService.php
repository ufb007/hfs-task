<?php

namespace App\Services;

use App\Repositories\ArticleRepository;

class ArticleService
{
    public function __construct(protected ArticleRepository $articleRepository)
    {}

    public function getArticleWithComments($slug)
    {
        return $this->articleRepository->findOne($slug);
    }
}