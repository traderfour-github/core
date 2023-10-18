<?php

namespace App\Jobs\V1\License\Terminal;

use App\Events\V1\My\License\Terminal\DeletedEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Terminal\ITerminalRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class DeleteJob extends SyncJob
{
    private ITerminalRepository $terminalRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(
        public $user_id,
        public $license_id
    ) {
        $this->terminalRepository = app()->make(ITerminalRepository::class);
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            $license = $this->terminalRepository->show($this->user_id, $this->license_id);

            if ($this->terminalRepository->deleteModel($license)) {
                event(new DeletedEvent($license));
            }

            return $license->id;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
