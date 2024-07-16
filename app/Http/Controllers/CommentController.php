<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct(protected CommentResource $commentResource)
    {}

    public function store(Request $request)
    {
        // $validate = $request->validated();

        // if (intval($validate['user_id']) !== Auth::id()) {
        //     return response()->json(['error' => 'Unauthorized.'], 403);
        // }

        // $newComment = $this->commentResource->create($request->validated());

        // return response()->json([
        //     'message' => 'Comment created successfully',
        //     'comment' => CommentResource::collection(new Collection([$newComment]))
        // ]);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        Gate::authorize('update', $comment);
        $this->commentResource->update($comment, $request->validated());
        
        return response()->json($comment);
    }

    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);
        $comment->delete();
        
        return response()->json($comment);
    }
}
