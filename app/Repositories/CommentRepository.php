<?php 

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    public function create(array $data): Comment
    {
        return Comment::create($data);
    }

    public function update(Comment $comment, array $data): Comment
    {
        $comment->fill($data)->save();
        return $comment;
    }
}