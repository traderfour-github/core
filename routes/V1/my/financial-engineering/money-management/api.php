<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'money-managements'], function (){
    include __DIR__.'/money-management.php';
});
