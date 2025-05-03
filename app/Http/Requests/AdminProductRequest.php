<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminProductRequest extends FormRequest
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
            'title' => 'required|max:255',
            'category_id' => 'required',
            'short_desc' => 'required|max:255',
            'full_desc' => 'required',
            'status' => 'required',
            'price' => 'required|numeric|max:9999999|gt:0',
            'quantity' => 'required|max:9999999|gt:0',
        ];
    }
}
