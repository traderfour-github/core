<?php

use App\Http\Controllers\V1\My\Account\Attachment\AttachmentController;
use Illuminate\Support\Facades\Route;

Route::controller(AttachmentController::class)->prefix('attachments')->group(function () {
    Route::post('/', 'create');
});
