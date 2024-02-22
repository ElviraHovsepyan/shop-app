<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAddressRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'company_name' => 'min:2|max:255',
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'address_1' => 'required',
            'address_2' => 'min:2|max:255|nullable',
            'postal_code' => 'required|numeric',
            'country_id' => 'required|numeric',
            'city' => 'required',
            'phone' => 'required',
            'notes' => 'min:2|max:255|nullable'
        ];
    }
}
