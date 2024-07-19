<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService)
    {}

    public function index(Request $request, Category $category)
    {
        $token = $request->attributes->get('token');

        return response()->json([
            'user' => Auth::user(),
            'category' => (new CategoryResource($category))->withArticles()
        ], 200);
    }
}
