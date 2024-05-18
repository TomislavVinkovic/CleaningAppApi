<?php

namespace App\Http\Requests\Listing;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'oib' => 'required|string|max:255',

            'listingDate' => 'required|date',
            'listingAddress' => 'required|string|max:255',
            'listingCity' => 'required|string|max:255',
            'listingPostalCode' => 'required|string|max:10',

            'listingType' => ['required', Rule::in(['rent', 'service'])],
            'listingCategory' => ['required', Rule::in(['carpet', 'sofa', 'car', 'kercher'])],
        ];

        switch ($this->listingCategory) {
            case 'carpet':
                $rules['listingCarpetArea'] = 'required|numeric';
                break;
            case 'sofa':
                $rules['listingSofaNumberOfSeats'] = 'required|integer';
                break;
            case 'car':
                $rules['listingCarType'] = ['required', Rule::in(['sedan', 'hatchback', 'suv', 'van', 'pickup', 'coupe', 'cabriolet', 'minivan'])];
                $rules['listingCarSeats'] = 'required|integer';
                break;
            case 'kercher':
                $rules['listingKercherPSI'] = 'required|integer';
                $rules['listingKercherChemicals'] = 'required|string|max:255';
                $rules['durationDays'] = 'required|integer|min:1';
                break;
        }

        return $rules;
    }
}
