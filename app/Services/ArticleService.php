<?php

namespace App\Services;

use App\Repositories\ArticleRepository;

class ArticleService
{
    public function __construct(protected ArticleRepository $articleRepository)
    {}
}