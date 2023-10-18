<?php

use App\Http\Controllers\V1\Search\SearchController;
use Illuminate\Support\Facades\Route;

Route::prefix('search')->group(function() {
    Route::get('/', [SearchController::class, 'index']);
});
