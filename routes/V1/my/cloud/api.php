<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cloud'], function(){
    include __DIR__.'/aws.php';
    include __DIR__.'/azure.php';
    include __DIR__.'/bulutly.php';
    include __DIR__.'/digital-ocean.php';
    include __DIR__.'/gcp.php';
    include __DIR__.'/linode.php';
});
