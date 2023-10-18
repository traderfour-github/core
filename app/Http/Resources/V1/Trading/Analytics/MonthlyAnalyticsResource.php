<?php

namespace App\Http\Resources\V1\Trading\Analytics;

use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyAnalyticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "monthly_analytics" => [

            ]
        ];
    }
}
