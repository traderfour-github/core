<?php

use App\Http\Controllers\V1\Trading\Account\AccountController;
use Illuminate\Support\Facades\Route;

Route::prefix('/accounts')->controller(AccountController::class)
    ->group(function(){
    Route::get('/', 'index');
    Route::get('/{uuid}', 'show');
});
