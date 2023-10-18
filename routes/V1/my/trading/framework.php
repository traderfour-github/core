<?php

use App\Http\Controllers\V1\My\Trading\Framework\FrameworkController;
use Illuminate\Support\Facades\Route;

Route::prefix('frameworks')->controller(FrameworkController::class)
    ->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{uuid}', 'show');
    Route::put('/{uuid}', 'update');
    Route::delete('/{uuid}', 'delete');
});
