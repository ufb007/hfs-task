<?php

namespace App\Http\Controllers;

use App\Services\TopicService;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    protected $topicService;

    public function __construct(TopicService $topicService)
    {
        $this->topicService = $topicService;
    }

    public function index()
    {
        $topics = $this->topicService->getAllTopicsWithCategories();

        return response()->json([
            'data' => $topics
        ]);
    }
}
