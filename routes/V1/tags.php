<?php

use App\Http\Controllers\V1\Post\TagController;
use Illuminate\Support\Facades\Route;

Route::prefix('tags')->group(function () {
    Route::get('/', [TagController::class, 'get'])->name('tags.index');
    Route::get('/{uuid}', [TagController::class, 'read'])->name('tags.show');
    Route::get('{uuid}/posts', [TagController::class, 'posts'])->name('tags.posts');
});
