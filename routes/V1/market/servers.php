<?php

use App\Http\Controllers\V1\Market\InstrumentController;
use App\Http\Controllers\V1\Market\ServerController;
use Illuminate\Support\Facades\Route;

Route::prefix('servers')->group(function() {
    Route::get('/{uuid}', [ServerController::class, 'show'])->name('servers.show');
    Route::get('/{uuid}/instruments', [InstrumentController::class, 'serverInstruments'])->name('servers.instruments');
});
