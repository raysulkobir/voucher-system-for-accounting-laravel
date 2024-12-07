<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreSaleRequest extends FormRequest
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
            "customer_id"   => "required|integer",
            "total_amount"  => "required|integer",
            "discount"      => "nullable|integer",
            "tax"           => "nullable|integer",
            "grand_total"   => "required|integer",
            "paid_amount"   => "required|integer",
            "due_amount"    => "nullable|integer",
            "payment_method"     => "nullable|integer",
            "payment_status"     => "required|integer",
            "sale_status"        => "required|integer",

            "products.*.product_id" => "required|integer",
            "products.*.product_name" => "required",
            "products.*.quantity" => "required|integer",
            "products.*.unit_price" => "required|integer",
            "products.*.subtotal" => "required|integer",
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
