<?php

namespace App\Services\RiskManagement;

use App\Models\Trader4\V1\FinancialEngineering\RiskManagement;
use App\Repositories\V1\FinancialEngineering\RiskManagement\RiskManagementRepository;

class UpdateRiskManagementService
{
    public function __construct(
        private RiskManagementRepository $riskManagementRepository
    ){
    }


    public function perform(RiskManagement $riskManagement, array $data) : \Illuminate\Database\Eloquent\Model
    {
       return $this->riskManagementRepository->updateModel($riskManagement, $data);
    }
}
