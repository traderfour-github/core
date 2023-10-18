<?php

use Illuminate\Support\Facades\Route;

Route::prefix('market')->group(function () {
    include __DIR__.'/servers.php';
});
