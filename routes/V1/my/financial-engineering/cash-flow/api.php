<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cash-flows'], function (){
    include __DIR__.'/operating.php';
    include __DIR__.'/investing.php';
    include __DIR__.'/financing.php';
    include __DIR__.'/cash-flows.php';
});
