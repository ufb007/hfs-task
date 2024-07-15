<?php

namespace App\Repositories;

use App\Models\Topic;

class TopicRepository
{
    public function getAllWithCategories()
    {
        return Topic::all();
    }
}