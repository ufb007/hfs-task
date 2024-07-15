<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'votes' => $this->votes->count(),
            'comments_count' => $this->comments->count(),
        ];
    }

    public function withComments()
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'content' => $this->content,
            'votes_up' => $this->votes->filter(fn ($vote) => $vote->vote === 'up')->count(),
            'votes_down' => $this->votes->filter(fn ($vote) => $vote->vote === 'down')->count(),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}
