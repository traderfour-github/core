<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return redirect('https://docs.trader4.net/apis/', 301);
});
