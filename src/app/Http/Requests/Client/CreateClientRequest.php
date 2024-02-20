<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'registration_code' => 'required_if:type,COMPANY|max:50',
            'address' => 'required|max:255',
            'phone' => 'nullable|max:25',
            'email' => 'nullable|email|max:50',
        ];
    }
}
