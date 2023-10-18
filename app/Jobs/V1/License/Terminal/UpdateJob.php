<?php

namespace App\Jobs\V1\License\Terminal;

use App\Events\V1\My\License\Terminal\UpdatedEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Terminal\ITerminalRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class UpdateJob extends SyncJob
{
    private ITerminalRepository $terminalRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(
        private string $user_id,
        private array $data,
        private string $id,
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
            $license = $this->terminalRepository->show($this->user_id, $this->id);

            if ($license = $this->terminalRepository->updateModel($license, $this->data)) {
                event(new UpdatedEvent($license));
            }

            return $license;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
