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
        $token = $request->attributes->get('token');

        return response()->json((new ArticleResource($article))->withComments());
    }

    public function store(CreateArticleRequest $request)
    {
        $validate = $request->validated();

        if (intval($validate['user_id']) !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $newArticle = $this->articleRepository->create($request->validated());

        return response()->json([
            'message' => 'Article created successfully',
            'article' => ArticleResource::collection(new Collection([$newArticle]))
        ]);
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        Gate::authorize('update', $article);
        $this->articleRepository->update($article, $request->validated());
        
        return response()->json($article);
    }
}
