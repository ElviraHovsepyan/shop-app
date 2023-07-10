<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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

        $this->request->set('is_active', $this->request->getBoolean('is_active'));
        $this->request->set('in_stock',$this->request->getBoolean('in_stock'));

        $this->request->remove('_token');
        return [
            'name' => 'min:2|max:255',
            'price' => 'numeric',
            'in_stock' => 'boolean',
            'is_active' => 'boolean',
            'quantity' => 'numeric',
            'pic' => 'image|mimes:png,jpg,jpeg|max:2048',
            'categories' => 'required',
            'filters_value' => 'required|string|min:1'
        ];
    }
}
