<?php

namespace App\Services\General;

use App\Repositories\V1\Market\Instrument\InstrumentRepository;

class InstrumentService
{
    public function __construct(
        private InstrumentRepository $repository
    ) {
    }

    public function read(string $id, array $data)
    {
        return $this->repository->read($id, $data);
    }

    public function serverInstruments(string $server_id)
    {
        return $this->repository->serverInstruments($server_id);
    }
}
