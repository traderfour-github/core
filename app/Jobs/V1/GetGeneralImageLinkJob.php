<?php

namespace App\Jobs\V1;

class GetGeneralImageLinkJob extends SyncJob
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private string $path)
    {
        //
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        return $this->link($this->path, true);
    }
}
