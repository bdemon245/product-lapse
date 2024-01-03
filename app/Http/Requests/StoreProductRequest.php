<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        if(request()->isMethod('post')){
            $role = 'required';
        }elseif(request()->isMethod('put')){
            $role= 'sometimes';
        }
        return [
            'name' => [$role, 'max:30'],
            'url' => [$role],
            'stage' => [$role],
            'logo' => [$role],
            'description' => [$role],
        ];
    }
}