<?php

namespace App\Repositories;

use App\Models\Topic;

class TopicRepository
{
    public function all()
    {
        return Topic::all();
    }

    
}