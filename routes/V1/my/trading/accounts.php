<?php

use App\Http\Controllers\V1\My\Trading\Account\AccountController;
use Illuminate\Support\Facades\Route;

Route::prefix('/accounts')->controller(AccountController::class)
    ->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{uuid}', 'show');
    Route::put('/{uuid}', 'update');
    Route::delete('/{uuid}', 'delete');
});
