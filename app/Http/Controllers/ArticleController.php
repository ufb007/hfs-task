<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct(protected ArticleRepository $articleRepository)
    {}

    public function show(Request $request, Article $article)
    {
        return response()->json((new ArticleResource($article))->withComments());
    }

    public function store(CreateArticleRequest $request)
    {
        $newArticle = $this->articleRepository->create($request->all());

        return response()->json([
            'message' => 'Article created successfully',
            'article' => ArticleResource::collection(new Collection([$newArticle]))
        ], 201);
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        Gate::authorize('update', $article);
        $this->articleRepository->update($article, $request->all());
        
        return response()->json($article);
    }

    public function destroy(Article $article)
    {
        Gate::authorize('delete', $article);
        $this->articleRepository->delete($article);
        
        return response()->json([
            'message' => 'Article deleted successfully',
        ]);
    }
}
