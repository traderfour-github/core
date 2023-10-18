<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'my', 'middleware' => 'auth.werify'], function(){
    include __DIR__.'/account/api.php';
    include __DIR__.'/cloud/api.php';
    include __DIR__.'/trading/api.php';
    include __DIR__.'/posts.php';
    include __DIR__.'/finance/api.php';
    include __DIR__.'/financial-engineering/api.php';
    include __DIR__.'/market/api.php';
    include __DIR__.'/license/api.php';
});
