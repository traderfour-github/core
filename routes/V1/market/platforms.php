<?php

use App\Http\Controllers\V1\Market\PlatformController;
use Illuminate\Support\Facades\Route;

Route::prefix('platforms')->group(function() {
    Route::get('/', [PlatformController::class, 'index'])->name('platforms.index');
    Route::get('/{uuid}', [PlatformController::class, 'read'])->name('platforms.show');
    Route::get('/{uuid}/products', [PlatformController::class, 'products'])->name('platforms.products');
});
