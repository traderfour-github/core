<?php

use App\Http\Controllers\V1\My\License\Terminal\TerminalController;
use Illuminate\Support\Facades\Route;

Route::prefix('terminals')->controller(TerminalController::class)
    ->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{uuid}', 'show');
        Route::put('/{uuid}', 'update');
        Route::delete('/{uuid}', 'delete');
});
