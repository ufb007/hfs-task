<?php

namespace App\Services;

use App\Repositories\TopicRepository;

class TopicService
{
    public function __construct(protected TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    public function getAllTopicsWithCategories()
    {
        return $this->topicRepository->getAllWithCategories();
    }
}