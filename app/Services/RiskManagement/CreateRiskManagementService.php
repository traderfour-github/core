<?php

namespace App\Services\RiskManagement;

use App\Repositories\V1\FinancialEngineering\RiskManagement\RiskManagementRepository;

class CreateRiskManagementService
{
    public function __construct(
        private RiskManagementRepository $riskManagementRepository
    ) {

    }

    public function perform(array $data)
    {
      return $this->riskManagementRepository->create($data);
    }
}
