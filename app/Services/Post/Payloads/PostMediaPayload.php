<?php

namespace App\Services\Post\Payloads;

use App\Models\App;
use Illuminate\Http\UploadedFile;

class PostMediaPayload
{

    public function __construct(
        private UploadedFile $logo,
        private UploadedFile $cover,
    ) {
    }

    public function getLogo(): UploadedFile
    {
        return $this->logo;
    }

    public function getCover(): UploadedFile
    {
        return $this->cover;
    }
}
