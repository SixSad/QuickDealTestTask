<?php

namespace App\Http\DTO;

readonly class UserObject
{
    public function __construct(
        public ?int    $id = null,
        public ?string $email = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this?->id,
            'email' => $this?->email,
        ];
    }
}
