<?php

namespace App\Services;

use App\Repositories\TopicRepository;

class TopicService
{
    public function __construct(protected TopicRepository $topicRepository)
    {}

    public function getAllTopicsWithCategories()
    {
        return $this->topicRepository->getAllWithCategories();
    }
}