<?php

use Illuminate\Support\Facades\Route;

Route::prefix('trading')->group(function(){
    include __DIR__.'/accounts.php';
    include __DIR__.'/bridge.php';
    include __DIR__.'/analytics.php';
    include __DIR__.'/framework.php';
});
