<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'trading-plans'], function (){
    include __DIR__.'/strategies/api.php';
    include __DIR__.'/trading-plan.php';
});
