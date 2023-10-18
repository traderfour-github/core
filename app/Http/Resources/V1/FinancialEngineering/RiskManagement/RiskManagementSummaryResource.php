<?php

namespace App\Http\Resources\V1\FinancialEngineering\RiskManagement;

use Illuminate\Http\Resources\Json\JsonResource;

class RiskManagementSummaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->id,
            'title' => $this->title,
            'public' => $this->public,
        ];
    }
}
