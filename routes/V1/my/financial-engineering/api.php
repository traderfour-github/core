<?php

use Illuminate\Support\Facades\Route;

Route::prefix('financial-engineering')->group(function(){
    include __DIR__.'/cash-flow/api.php';
    include __DIR__.'/money-management/api.php';
    include __DIR__.'/risk-management/api.php';
    include __DIR__.'/trading-plan/api.php';
});
