<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'strategies'], function (){
    include __DIR__.'/exits.php';
    include __DIR__.'/entries.php';
    include __DIR__.'/strategies.php';
});
