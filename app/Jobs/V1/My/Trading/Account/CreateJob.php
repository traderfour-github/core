<?php

namespace App\Jobs\V1\My\Trading\Account;

use App\Repositories\V1\My\Trading\Account\AccountRepository;
use App\Repositories\V1\Market\Broker\BrokerRepository;
use App\Events\V1\My\Trading\Account\CreatedEvent;
use App\Enums\V1\Trading\Account\StatusesEnum;
use Illuminate\Support\Facades\Crypt;
use App\Jobs\V1\SyncJob;
use Exception;

class CreateJob extends SyncJob
{
    private $repository, $brokerRepository, $crypt;

    /**
     * @param  string  $userId
     * @param  array  $data
     */
    public function __construct(
        private string $userId,
        private array $data
    ) {
        $this->repository = new AccountRepository();
        $this->brokerRepository = new BrokerRepository();
        $this->crypt = new Crypt();
    }

    /**
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            $this->data['user_id'] = $this->userId;
            $this->data['market_id'] = $this->brokerRepository->find($this->data['broker_id'])->market_id;
            $this->data['status'] = StatusesEnum::Registered->value;
            $tradingAccount = $this->repository->transactional(fn() => $this->repository->store($this->data));

            if($tradingAccount){
                CreatedEvent::dispatch($tradingAccount);
                return $tradingAccount;
            }
            $this->exceptionHandler(throw new Exception('Failed to create trading account'));
        } catch (Exception $e) {
            $this->exceptionHandler($e);
        }
    }
}
