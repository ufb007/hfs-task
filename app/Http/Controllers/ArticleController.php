<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(protected ArticleService $articleService)
    {}

    public function show(Request $request, $slug, $article_slug)
    {
        $token = $request->attributes->get('token');
        $article = $this->articleService->getArticleWithComments($article_slug);

        return response()->json([
            'token' => $token,
            'article' => (new ArticleResource($article))->withComments(),
        ]);
    }
}
