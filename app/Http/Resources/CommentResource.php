<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'article_id' => $this->article_id,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'content' => $this->content,
            'parent_id' => $this->parent_id,
            'replies' => CommentResource::collection($this->orderedReplies),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
