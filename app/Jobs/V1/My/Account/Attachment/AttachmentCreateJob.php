<?php

namespace App\Jobs\V1\My\Account\Attachment;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\Account\Attachment\IAttachmentRepository;

class AttachmentCreateJob extends SyncJob
{
    public IAttachmentRepository $repository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private array $data,
        private string $userId
    ) {
        $this->repository = app()->make(IAttachmentRepository::class);
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        try {
            return $this->repository->create([
                'user_id' => $this->userId,
                'path' => $this->upload($this->data['file']),
                'type' => $this->data['type'],
            ]);
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
