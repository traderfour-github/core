<?php

namespace App\Jobs\V1;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use function Sentry\captureException;

class ASyncJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        //
    }

    /**
     * @param  \Exception  $exception
     *
     * @return void
     * @throws \Exception
     */
    public function exceptionHandler(\Exception $exception): void
    {
        captureException($exception);
        throw new \Exception($exception);
    }

}
