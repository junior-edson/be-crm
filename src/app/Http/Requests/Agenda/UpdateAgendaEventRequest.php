<?php

namespace App\Http\Requests\Agenda;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgendaEventRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'initial_date' => 'required|date_format:Y-m-d',
            'final_date' => 'required|nullable|date_format:Y-m-d|after_or_equal:initial_date',
        ];

        if ($this->has('client_id') && $this->filled('client_id')) {
            $rules['client_id'] = 'exists:clients,id';
        }

        if ($this->has('initial_time') && $this->filled('initial_time')) {
            $rules['final_time'] = 'required|after:initial_time|date_format:H:i';
            $rules['initial_time'] = 'required|date_format:H:i';
        }

        return $rules;
    }
}
