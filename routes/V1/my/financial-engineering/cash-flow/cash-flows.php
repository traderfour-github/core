<?php

use App\Http\Controllers\V1\FinancialEngineering\CashFlows\CashFlowController;
use Illuminate\Support\Facades\Route;

Route::controller(CashFlowController::class)
     ->group(function(){
         Route::get('/', 'index');
         Route::post('/', 'store');
         Route::get('/{uuid}', 'show');
         Route::put('/{uuid}', 'update');
         Route::delete('/{uuid}', 'delete');
     });
