<?php

namespace App\Http\Resources\Balance;

use Illuminate\Http\Resources\Json\JsonResource;

class BalanceResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'balance' => round($this->balance,2),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
