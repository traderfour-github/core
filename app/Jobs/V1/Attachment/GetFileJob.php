<?php

namespace App\Jobs\V1\Attachment;

use App\Jobs\V1\SyncJob;
use Illuminate\Support\Facades\Storage;

class GetFileJob extends SyncJob
{
    public function __construct(private string $path)
    {
        //
    }

    public function handle(): string
    {
        try {
            return Storage::disk('s3')->get($this->path);
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
