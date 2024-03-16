<?php

namespace App\Http\Requests;

class UpdateBalanceRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'balance' => ['numeric', 'required', 'min:1']
        ];
    }
}
