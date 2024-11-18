<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateAccountsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'account_name' => 'required|string|max:255', // Ensure it's a string and fits within VARCHAR(255)
            'account_type' => 'required|string|max:255', // Matches the column type as VARCHAR
            'balance' => 'required|numeric|min:0', // Numeric with a minimum of 0 for valid balance
            'account_number' => 'nullable|string|max:255', // Unique if provided
            'bank_name' => 'nullable|string|max:255', // Optional bank name
            'currency' => 'required|string|size:3', // Must be a 3-character currency code (e.g., USD)
            'description' => 'nullable|string', // Optional description
            'is_active' => 'nullable|boolean', // Boolean validation for active/inactive
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
