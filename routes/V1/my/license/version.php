<?php

use App\Http\Controllers\V1\My\License\Version\VersionController;
use Illuminate\Support\Facades\Route;

Route::prefix('versions')->controller(VersionController::class)
    ->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{uuid}', 'show');
        Route::put('/{uuid}', 'update');
        Route::delete('/{uuid}', 'delete');
});
