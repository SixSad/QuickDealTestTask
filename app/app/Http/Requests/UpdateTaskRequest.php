<?php

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{

    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['prohibited'],
            'name' => ['string', 'max:256'],
            'status' => ['string', Rule::enum(Status::class)],
            'created_at' => ['prohibited'],
            'updated_at' => ['prohibited'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

}
