<?php

use App\Http\Controllers\V1\FinancialEngineering\TradingPlan\TradingPlanController;
use Illuminate\Support\Facades\Route;

Route::controller(TradingPlanController::class)
    ->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{uuid}', 'show');
    Route::put('/{uuid}', 'update');
    Route::delete('/{uuid}', 'delete');
});
