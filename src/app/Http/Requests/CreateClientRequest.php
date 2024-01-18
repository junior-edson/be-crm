<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'team_id' => 'required|exists:teams,id',
            'type' => 'required|in:INDIVIDUAL,COMPANY',
            'tax_type' => 'required|in:TAX_21_PERCENT,SELF_LIQUIDATION,SUBCONTRACTOR',
            'registration_code' => 'nullable',
            'address' => 'required',
            'phone' => 'nullable',
            'email' => 'nullable|email',
        ];
    }
}
