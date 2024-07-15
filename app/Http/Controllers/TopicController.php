<?php

namespace App\Http\Controllers;

use App\Http\Resources\TopicResource;
use App\Models\Topic;
use App\Services\TopicService;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function __construct(protected TopicService $topicService)
    {}

    public function index(Request $request)
    {
        $token = $request->attributes->get('token');
        $topics = Topic::all();

        return response()->json([
            'token' => $token,
            'topics' => TopicResource::collection($topics),
        ]);
    }
}
