<?php

use App\Http\Controllers\V1\My\License\License\LicenseController;
use Illuminate\Support\Facades\Route;

Route::prefix('licenses')->controller(LicenseController::class)
    ->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{uuid}', 'show');
        Route::put('/{uuid}', 'update');
        Route::delete('/{uuid}', 'delete');
});
