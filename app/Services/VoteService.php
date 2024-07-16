<?php

namespace App\Services;

use App\Models\Vote;
use App\Repositories\VoteRepository;
use Illuminate\Support\Facades\Auth;

class VoteService
{
    public function __construct(protected VoteRepository $voteRepository)
    {}

    public function createUpdateDelete(array $data)
    {
        $currentVote = Vote::where(['article_id' => $data['article_id'], 'user_id' => Auth::user()->id])->first();

        if ($currentVote && $currentVote->vote === $data['vote']) {
            $this->voteRepository->delete($currentVote);

            return "You removed your vote for this article";
        } else if ($currentVote) {
            $vote = $this->voteRepository->update($currentVote, $data);

            return "You changed to {$vote->vote}voted for this article";
        }

        $vote = $this->voteRepository->create($data);

        return "You {$vote->vote}voted this article";
    }
}