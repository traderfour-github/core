<?php

namespace App\Jobs\V1\My\Account\Attachment;

use App\Jobs\V1\SyncJob;

class GetAttachmentLinkJob extends SyncJob
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
        try {
            return $this->link($this->path, true);
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
