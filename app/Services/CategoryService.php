<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    public function __construct(protected CategoryRepository $categoryRepository)
    {}

    public function getAllWithArticles($slug)
    {
        return $this->categoryRepository->getWithArticlesBySlug($slug);
    }
}