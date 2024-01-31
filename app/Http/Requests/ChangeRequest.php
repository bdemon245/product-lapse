<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeRequest extends FormRequest
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
            'title' => 'sometimes|required|string',
            'classification' => 'sometimes|required',
            'priority' => 'sometimes|required',
            'status' => 'sometimes|required',
            'details' => 'sometimes|required',
            'administrator' => 'sometimes|required',
            'required_completion_date' => 'sometimes|required|date',
        ];
    }
}
