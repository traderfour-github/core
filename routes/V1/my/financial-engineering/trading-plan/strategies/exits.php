<?php

use App\Http\Controllers\V1\FinancialEngineering\ExitStrategy\ExitStrategyController;
use Illuminate\Support\Facades\Route;

Route::controller(ExitStrategyController::class)->prefix('exits')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{uuid}', 'show');
    Route::put('/{uuid}', 'update');
    Route::delete('/{uuid}', 'delete');
});
