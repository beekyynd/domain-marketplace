<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'status' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'max:40'],
            'domain_id' => ['required', 'integer', 'max:5'],
            'amount' => ['required', 'integer', 'max:20'],
            'reference' => ['required', 'string', 'max:20'],
            
        ];
    }

}
