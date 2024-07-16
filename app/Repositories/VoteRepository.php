<?php

namespace App\Repositories;

use App\Models\Vote;

class VoteRepository
{
    public function create(array $data): Vote
    {
        return Vote::create($data);
    }

    public function update(Vote $vote, array $data): Vote
    {
        $vote->fill($data)->save();
        return $vote;
    }

    public function delete(Vote $vote): bool
    {
        return $vote->delete();
    }
}