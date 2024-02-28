<?php

namespace App\Http\Requests\Quotation;

use Illuminate\Foundation\Http\FormRequest;

class CreateDraftQuotationRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'client_name' => 'required|string',
            'company_name' => 'required|string',
            'company_email' => 'required|email',
            'company_address' => 'required|string',
            'tax_type' => 'required|string',
            'currency' => 'required|string',
        ];
    }
}
