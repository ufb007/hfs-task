<?php

namespace App\Http\Resources;

use App\Models\User;
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
            'user_name' => User::find($this->user_id)->name,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => $this->slug,
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
            'slug' => $this->slug,
            'content' => $this->content,
            'votes_up' => $this->votes->filter(fn ($vote) => $vote->vote === 'up')->count(),
            'votes_down' => $this->votes->filter(fn ($vote) => $vote->vote === 'down')->count(),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}
