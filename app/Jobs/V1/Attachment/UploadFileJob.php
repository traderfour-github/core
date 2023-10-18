<?php

namespace App\Jobs\V1\Attachment;

use App\Jobs\V1\SyncJob;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadFileJob extends SyncJob
{
    public function __construct(private ?UploadedFile $image)
    {
        //
    }

    public function handle(): string
    {
        try {
            $extension = $this->image->extension();
            $filename = Str::uuid() . '.' . $extension;
            $path = 'test/' . $filename;
            Storage::disk('s3')->put($path, $this->image);
            return $path;
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
