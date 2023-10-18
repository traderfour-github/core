<?php

use App\Http\Controllers\V1\My\Market\ServerController;
use Illuminate\Support\Facades\Route;

Route::prefix('servers')->controller(ServerController::class)->group(function() {
    Route::post('/', 'store')->name('servers.store');
});
