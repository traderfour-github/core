<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'trading'], function(){
    include __DIR__.'/analytics.php';
    include __DIR__.'/accounts.php';
    include __DIR__.'/frameworks.php';
});
