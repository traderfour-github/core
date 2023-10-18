<?php

use App\Http\Controllers\V1\My\Trading\Bridge\BridgeController;
use Illuminate\Support\Facades\Route;

Route::prefix('bridge')->controller(BridgeController::class)
    ->group(function(){
        Route::post('/webhook', 'call');
        Route::post('/join', 'join');
});
