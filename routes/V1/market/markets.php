<?php

use App\Http\Controllers\V1\Market\MarketController;
use App\Http\Controllers\V1\Market\PlatformController;
use Illuminate\Support\Facades\Route;

Route::prefix('markets')->group(function() {
    Route::get('/', [MarketController::class, 'index'])->name('markets.index');
    Route::get('/{uuid}', [MarketController::class, 'show'])->name('markets.show');
    Route::get('/{uuid}/platforms', [PlatformController::class, 'marketPlatforms'])->name('markets.platforms');
});
