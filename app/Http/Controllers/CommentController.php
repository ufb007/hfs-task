<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct(protected CommentRepository $commentRepository)
    {}

    public function store(CreateCommentRequest $request)
    {
        $newComment = $this->commentRepository->create($request->all());

        return response()->json([
            'message' => 'Comment created successfully',
            'comment' => CommentResource::collection(new Collection([$newComment]))
        ], 201);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        Gate::authorize('update', $comment);
        $this->commentRepository->update($comment, $request->all());
        
        return response()->json($comment, 201);
    }

    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);
        $comment->delete();
        
        return response()->json([
            'message' => 'Comment deleted successfully',
        ]);
    }
}
