<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\TopicController;
use App\Http\Middleware\AuthenticateWithApiToken;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::post('/authenticate', [ApiController::class, 'authenticate'])->name('api.authenticate');

Route::middleware(AuthenticateWithApiToken::class)->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/topics', [TopicController::class, 'index'])->name('api.topics');
});