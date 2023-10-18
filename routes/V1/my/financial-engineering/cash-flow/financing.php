<?php

use App\Http\Controllers\V1\FinancialEngineering\CashFlows\FinancingController;
use Illuminate\Support\Facades\Route;

Route::controller(FinancingController::class)->group(function () {
    Route::prefix('financings')->group(function () {
        Route::post('/', 'store');
        Route::get('/{uuid}', 'show');
        Route::put('/{uuid}', 'update');
        Route::delete('/{uuid}', 'delete');
    });
    Route::get('/{cash_flow_uuid}/financings', 'index');
});
