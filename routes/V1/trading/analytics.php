<?php

use App\Http\Controllers\V1\Trading\Analytics\AdvancedStatisticsController ;
use App\Http\Controllers\V1\Trading\Analytics\MonthlyAnalyticsController ;
use App\Http\Controllers\V1\Trading\Analytics\TradingActivityController ;
use App\Http\Controllers\V1\Trading\Analytics\TradingController ;
use App\Http\Controllers\V1\Trading\Analytics\InfoController;
use App\Http\Controllers\V1\Trading\Analytics\ChartController ;

use Illuminate\Support\Facades\Route;


Route::controller(InfoController::class)
     ->group(function(){
         Route::get('info/{trading_account}', 'index');
     });


Route::controller(AdvancedStatisticsController::class)
     ->group(function(){
         Route::get('advanced_statistics/{trading_account}', 'index');
     });


Route::controller(TradingController::class)
     ->group(function(){
         Route::get('trading_data/{trading_account}', 'index');
     });


Route::controller(TradingActivityController::class)
     ->group(function(){
         Route::get('trading_activity/{trading_account}', 'index');
     });


Route::controller(ChartController::class)
     ->group(function(){
         Route::get('chart/{trading_account}', 'index');
     });


Route::controller(MonthlyAnalyticsController::class)
     ->group(function(){
         Route::get('monthly_analytics/{trading_account}', 'index');
     });
