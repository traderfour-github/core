<?php

use App\Http\Controllers\V1\Market\RegulationController;
use Illuminate\Support\Facades\Route;

Route::prefix('regulations')->controller(RegulationController::class)->group(function() {
    Route::get('/', 'index')->name('regulations.index');
});
