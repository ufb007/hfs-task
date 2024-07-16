<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthenticateWithApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('api.authenticate');

Route::post('/users', [UserController::class, 'store'])->name('api.users.store');
Route::get('/topics', [TopicController::class, 'index'])->name('api.topics');
Route::get('/category/{category}', [CategoryController::class, 'index']);
Route::get('/article/{article:slug}', [ArticleController::class, 'show']);

Route::middleware(AuthenticateWithApiToken::class)->group(function () {
    Route::put('/users/{user}', [UserController::class, 'update'])->name('api.users.update');
    Route::put('/article/{article}', [ArticleController::class, 'update']);
});