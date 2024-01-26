<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDescuentoRequest extends FormRequest
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
            'toggle' => ['nullable', 'boolean'],
            'es_nacional' => ['exclude_if:toggle,true', 'required', 'boolean'],
            'hasta' => ['exclude_if:toggle,true', 'required', 'integer'],
            'porcentaje' => ['exclude_if:toggle,true', 'required', 'integer']
        ];
    }
}
