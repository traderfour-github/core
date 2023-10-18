<?php

use App\Http\Controllers\V1\Post\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'get'])->name('categories.index');
    Route::get('/{uuid}', [CategoryController::class, 'children'])->name('categories.children');
    Route::get('{uuid}/posts', [CategoryController::class, 'posts'])->name('categories.posts');
});
