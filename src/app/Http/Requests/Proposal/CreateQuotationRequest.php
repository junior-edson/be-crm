<?php

namespace App\Http\Requests\Proposal;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuotationRequest extends FormRequest
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
            'team_id' => 'required|exists:teams,id',
            'client_id' => 'required|exists:clients,id',
            'issue_date' => 'required|date',
            'due_date' => 'required|date',
            'client_name' => 'required|string',
            'client_email' => 'email',
            'client_address' => 'string',
            'company_name' => 'required|string',
            'company_email' => 'required|email',
            'company_address' => 'required|string',
            'tax_type' => 'required|string',
            'currency' => 'required|string',
            'notes' => 'string',
            'status' => 'string',
            'items' => 'array',
        ];
    }
}
