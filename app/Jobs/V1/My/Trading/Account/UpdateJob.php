<?php

namespace App\Jobs\V1\My\Trading\Account;

use App\Repositories\V1\My\Trading\Account\AccountRepository;
use App\Repositories\V1\Market\Broker\BrokerRepository;
use App\Events\V1\My\Trading\Account\UpdatedEvent;
use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Support\Facades\Crypt;
use App\Jobs\V1\SyncJob;
use Exception;

class UpdateJob extends SyncJob
{
    private $repository, $brokerRepository, $crypt;

    /**
     * @param  string  $uuid
     * @param  array  $data
     */
    public function __construct(
        private string $uuid,
        private array $data
    ) {
        $this->repository = new AccountRepository();
        $this->brokerRepository = new BrokerRepository();
        $this->crypt = new Crypt();
    }

    /**
     *
     * @return Account
     * @throws Exception
     */
    public function handle() : Account
    {
        try {
            $findTradingAccount = $this->repository->findOneBy(['id' => $this->uuid]);

            $this->data['market_id'] = $this->brokerRepository->find($this->data['broker_id'])->market_id;

            $tradingAccount = $this->repository->transactional(
                fn() => $this->repository->updated($findTradingAccount ,$this->data)
            );

            if($tradingAccount){
                UpdatedEvent::dispatch($tradingAccount);
                return $tradingAccount;
            }

            $this->exceptionHandler(throw new Exception('Failed to update trading account'));
        } catch (Exception $e) {
            $this->exceptionHandler($e);
        }
    }
}
