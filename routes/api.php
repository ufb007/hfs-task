<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TopicController;
use App\Http\Middleware\AuthenticateWithApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::post('/authenticate', [ApiController::class, 'authenticate'])->name('api.authenticate');

Route::middleware(AuthenticateWithApiToken::class)->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/topics', [TopicController::class, 'index'])->name('api.topics');
    Route::get('/category/{slug}', [CategoryController::class, 'index']);
    Route::get('/category/{slug}/article/{article_slug}', [ArticleController::class, 'show']);
});