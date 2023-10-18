<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'finance'], function(){
    include __DIR__.'/transactions.php';
    include __DIR__.'/payments.php';
    include __DIR__.'/subscriptions.php';
    include __DIR__.'/licenses.php';
});
