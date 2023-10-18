<?php

use App\Http\Controllers\V1\Market\InstrumentController;
use Illuminate\Support\Facades\Route;

Route::prefix('instruments')->group(function() {
    Route::get('/{uuid}', [InstrumentController::class, 'show'])->name('instruments.show');
});
