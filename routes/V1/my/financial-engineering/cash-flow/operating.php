<?php

use App\Http\Controllers\V1\FinancialEngineering\CashFlows\OperatingController;
use Illuminate\Support\Facades\Route;

Route::controller(OperatingController::class)->group(function () {
    Route::prefix('operatings')->group(function () {
        Route::post('/', 'store');
        Route::get('/{uuid}', 'show');
        Route::put('/{uuid}', 'update');
        Route::delete('/{uuid}', 'delete');
    });
    Route::get('/{cash_flow_uuid}/operatings', 'index');
});
