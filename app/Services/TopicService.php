<?php

namespace App\Services;

use App\Repositories\TopicRepository;

class TopicService
{
    protected $topicRepository;

    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    public function getAllTopicsWithCategories()
    {
        return $this->topicRepository->getAllWithCategories();
    }
}