<?php

use Illuminate\Support\Facades\Route;

Route::prefix('account')->group(function(){
    include __DIR__.'/attachments.php';
});
