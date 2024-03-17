<?php

namespace App\Http\DTO;

readonly class BalanceDTO extends BaseDTO
{
    public function __construct(
        public ?int   $user_id = null,
        public ?float $balance = null,
    )
    {
    }

}
