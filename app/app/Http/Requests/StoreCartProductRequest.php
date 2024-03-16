<?php

namespace App\Http\Requests;

class StoreCartProductRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
        ];
    }

}
