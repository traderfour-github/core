<?php

use App\Http\Controllers\V1\Trading\Framework\FrameworkController;
use Illuminate\Support\Facades\Route;

Route::prefix('/frameworks')->controller(FrameworkController::class)
    ->group(function(){
    Route::get('/', 'index');
    Route::get('/{uuid}', 'show');
});
