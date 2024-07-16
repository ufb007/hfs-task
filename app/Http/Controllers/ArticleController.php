<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct(protected ArticleService $articleService)
    {}

    public function show(Request $request, Article $article)
    {
        $token = $request->attributes->get('token');

        return response()->json([
            'token' => $token,
            'article' => (new ArticleResource($article))->withComments(),
        ]);
    }

    public function store(Request $request, Article $article)
    {
        Gate::authorize('create', $article);
    }

    public function update(Request $request, Article $article)
    {
        Gate::authorize('update', $article);
        $article->fill($request->all())->save();
        
        return response()->json($article);
    }
}
