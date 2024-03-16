<?php

namespace App\Http\DTO;

readonly class BalanceObject
{
    public function __construct(
        public ?int   $id = null,
        public ?int   $user_id = null,
        public ?float $balance = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this?->id,
            'user_id' => $this?->user_id,
            'balance' => $this?->balance,
        ];
    }
}
