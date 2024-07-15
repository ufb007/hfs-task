<?php

namespace App\Repositories;

use App\Models\Topic;

class TopicRepository
{
    protected $model;

    public function __construct(Topic $model)
    {
        $this->model = $model;
    }

    public function getAllWithCategories()
    {
        return $this->model->with('category')->get();
    }
}