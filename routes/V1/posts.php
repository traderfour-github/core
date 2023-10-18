<?php

use App\Http\Controllers\V1\Post\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('posts')->group(function(){
    Route::get('/', [PostController::class, 'index']);
    Route::get('/{slogan}', [PostController::class, 'show']);
    Route::get('{uuid}/related', [PostController::class, 'related']);
});

