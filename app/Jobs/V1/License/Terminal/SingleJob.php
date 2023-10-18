<?php

namespace App\Jobs\V1\License\Terminal;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Terminal\ITerminalRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class SingleJob extends SyncJob
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
        public $id
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
            return $this->terminalRepository->show($this->user_id, $this->id);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
