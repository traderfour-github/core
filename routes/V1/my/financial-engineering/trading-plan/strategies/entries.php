<?php

use App\Http\Controllers\V1\FinancialEngineering\Entry\EntryStrategyController;
use Illuminate\Support\Facades\Route;

Route::controller(EntryStrategyController::class)->prefix('entries')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{uuid}', 'show');
    Route::put('/{uuid}', 'update');
    Route::delete('/{uuid}', 'delete');
});
