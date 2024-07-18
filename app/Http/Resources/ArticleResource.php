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
            'user_name' => User::find($this->user_id)->name,
            'user' => [
                'id' => $this->user->id, 
                'name' => $this->user->name, 
                'email' => $this->user->email 
            ],
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'votes' => $this->votes->count(),
            'created_at' => $this->created_at->diffForHumans(),
            'comments_count' => $this->comments->count(),
        ];
    }

    public function withComments()
    {
        return [
            'id' => $this->id,
            'user_name' => User::find($this->user_id)->name,
            'user' => [
                'id' => $this->user->id, 
                'name' => $this->user->name, 
                'email' => $this->user->email 
            ],
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'created_at' => $this->created_at->diffForHumans(),
            'votes_up' => $this->votes->filter(fn ($vote) => $vote->vote === 'up')->count(),
            'votes_down' => $this->votes->filter(fn ($vote) => $vote->vote === 'down')->count(),
            'comments' => CommentResource::collection($this->orderedComments),
        ];
    }
}
