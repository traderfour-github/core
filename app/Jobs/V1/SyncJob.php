<?php

namespace App\Jobs\V1;

use App\Concerns\FileSystem;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

use function Sentry\captureException;

class SyncJob
{
    use Dispatchable, SerializesModels, FileSystem;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param  \Exception  $exception
     *
     * @return void
     */
    public function exceptionHandler(\Exception $exception): void
    {
        captureException($exception);
        throw new \Exception($exception);
    }
}
