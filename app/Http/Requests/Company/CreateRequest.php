<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'companyName' => 'required|string|max:255',
            'companyOib' => 'required|string|min:11|max:11|unique:companies,oib',
            'companyDescription' => 'nullable|string|max:1000',
            'companyAddress' => 'required|string|max:255',
            'companyCity' => 'required|string|max:255',
            'companyPostalCode' => 'required|string|max:10',
        ];
    }
}
