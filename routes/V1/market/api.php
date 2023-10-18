<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'market'], function(){
    include __DIR__.'/brokers.php';
    include __DIR__.'/instruments.php';
    include __DIR__.'/markets.php';
    include __DIR__.'/regulations.php';
    include __DIR__.'/platforms.php';
    include __DIR__.'/servers.php';
});
