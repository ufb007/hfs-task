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
        $validate = $request->validated();

        if (intval($validate['user_id']) !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $message = $this->voteService->createUpdateDelete($request->all());

        return response()->json(['message' => $message]);
    }
}
