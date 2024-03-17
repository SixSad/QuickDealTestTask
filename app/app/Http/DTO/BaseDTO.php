<?php

namespace App\Http\DTO;

readonly class BaseDTO
{
    public ?int $id;

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

}

