<?php

use App\Http\Controllers\V1\Market\BrokerController;
use App\Http\Controllers\V1\Market\PlatformController;
use App\Http\Controllers\V1\Market\ServerController;
use Illuminate\Support\Facades\Route;

Route::prefix('brokers')->group(function() {
    Route::get('/', [BrokerController::class, 'index'])->name('brokers.index');
    Route::get('/{uuid}', [BrokerController::class, 'show'])->name('brokers.show');
    Route::get('/{uuid}/platforms', [PlatformController::class, 'brokerPlatforms'])->name('brokers.platforms');
    Route::get('/{uuid}/servers', [ServerController::class, 'brokerServers'])->name('brokers.servers');
});
