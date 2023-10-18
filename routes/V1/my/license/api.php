<?php

use Illuminate\Support\Facades\Route;

Route::prefix('license')->group(function(){
    include __DIR__.'/license.php';
    include __DIR__.'/version.php';
    include __DIR__.'/terminal.php';
    include __DIR__.'/licensable.php';
});
