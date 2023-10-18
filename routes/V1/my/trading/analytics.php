<?php

use App\Http\Controllers\V1\Trading\Analytics\InfoController;
use Illuminate\Support\Facades\Route;

Route::prefix('analytics')->controller(InfoController::class)
    ->group(function(){
        Route::get('/{trading_account}', 'index');
});
