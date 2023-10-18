<?php

use App\Http\Controllers\V1\My\License\Licensable\LicensableController;
use Illuminate\Support\Facades\Route;

Route::prefix('licensable')->controller(LicensableController::class)
    ->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{uuid}', 'show');
        Route::put('/{uuid}', 'update');
        Route::delete('/{uuid}', 'delete');
});
