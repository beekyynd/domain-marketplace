<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDomainRequest extends FormRequest
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

            'url' => ['required', 'string', 'max:20'],
            'id' => ['required', 'integer', 'max:20'],
            
        ];
    }

    /**
     * Custom error message
     */

     public function messages(): array
     {
        
        return [

            'url.required' => 'You cannot submit an empty domain',
        ];
     }
}
