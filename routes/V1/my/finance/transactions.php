<?php

use App\Http\Controllers\V1\Post\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('transactions')->group(function (){
    Route::get('/', [PostController::class, 'get']);
    Route::get('/{uuid}', [PostController::class, 'show']);
    Route::post('/', [PostController::class, 'store']);
    Route::put('/{uuid}', [PostController::class, 'update']);
    Route::delete('/{uuid}', [PostController::class, 'delete']);
});
