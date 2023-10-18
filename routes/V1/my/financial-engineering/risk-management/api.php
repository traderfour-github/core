<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'risk-managements'], function (){
    include __DIR__.'/risk-management.php';
});
