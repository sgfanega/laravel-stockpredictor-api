<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockPredictionResource extends JsonResource
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
            'id' => (string)$this->id,
            'attributes' => [
                'ticker_symbol' => $this->ticker_symbol,
                'company_name' => $this->company_name,
                'confidence' => (string)$this->confidence,
                'predictions' => $this->predictions
            ]
        ];
    }
}
