<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'topic_id' => $this->topic_id,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at->diffForHumans(),
            'article_count' => $this->articles->count(),
        ];
    }

    /**
     * Retrieve the resource with associated articles.
     *
     * @return array
     */
    public function withArticles(): array
    {
        return [
            'id' => $this->id,
            'topic_id' => $this->topic_id,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at->diffForHumans(),
            'articles' => ArticleResource::collection($this->whenLoaded('articles')),
        ];
    }
}
