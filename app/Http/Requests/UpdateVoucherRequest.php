<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateVoucherRequest extends FormRequest
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
            'voucher_number' => 'required|string|max:255|unique:vouchers,voucher_number',
            'account_id'     => 'required|integer', // Ensures account exists
            'amount'         => 'required|numeric|min:0', // Non-negative decimal
            'voucher_type'   => 'required|string|max:255', // Adjust based on valid types
            'voucher_date'   => 'required|date|before_or_equal:today', // Valid date, not future
            'reference'      => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'created_by'     => 'nullable|integer', // Ensure user exists
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
