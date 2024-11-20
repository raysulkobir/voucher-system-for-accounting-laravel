<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLedgerRequest extends FormRequest
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
            "account_id" => "required|integer",
            "transaction_id" => "nullable|integer",
            "debit" => "nullable|numeric|min:0",
            "credit" => "nullable|numeric|min:0",
            "balance" => "required|numeric",
            "description" => "nullable|string|max:255",
            "transaction_date" => "required|date"
        ];
    }
}
