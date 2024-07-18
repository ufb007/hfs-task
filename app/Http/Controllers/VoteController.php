<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Models\Vote;
use App\Repositories\VoteRepository;
use App\Services\VoteService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class VoteController extends Controller
{
    public function __construct(
        protected VoteRepository $voteRepository, 
        protected VoteService $voteService)
    {}

    public function store(CreateVoteRequest $request)
    {
        $message = $this->voteService->createUpdateDelete($request->all());
        $votes = Vote::where('article_id', $request->article_id)->get();

        return response()->json([
            'message' => $message,
            'votes' => [
                'up' => $votes->where('vote', 'up')->count(),
                'down' => $votes->where('vote', 'down')->count()
            ]
        ], 200);
    }
}
