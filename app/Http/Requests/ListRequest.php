<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'sort' => 'string|min:2|max:255',
            'search' => 'string|nullable',
            'page' => 'numeric|min:1',
            'filters_value' => 'string|nullable',
            'price' => 'string|nullable',
            'category' => 'numeric|nullable'
        ];
    }
}
