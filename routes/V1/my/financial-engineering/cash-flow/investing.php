<?php

use App\Http\Controllers\V1\FinancialEngineering\CashFlows\InvestingController;
use Illuminate\Support\Facades\Route;

Route::controller(InvestingController::class)->group(function () {
    Route::prefix('investings')->group(function () {
        Route::post('/', 'store');
        Route::get('/{uuid}', 'show');
        Route::put('/{uuid}', 'update');
        Route::delete('/{uuid}', 'delete');
    });
    Route::get('/{cash_flow_uuid}/investings', 'index');
});
