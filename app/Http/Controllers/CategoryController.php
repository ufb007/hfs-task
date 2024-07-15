<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService)
    {}

    public function index(Request $request, Category $category)
    {
        $token = $request->attributes->get('token');

        return response()->json([
            'token' => $token,
            'category' => (new CategoryResource($category))->withArticles(),
        ]);
    }
}
