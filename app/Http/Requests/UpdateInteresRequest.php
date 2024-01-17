<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInteresRequest extends FormRequest
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
            'vigencia' => ['exclude_if:toggle,true', 'required', 'date_format:Y', 'after:1970', 'before:today'],
            'mes' => ['exclude_if:toggle,true', 'required', 'integer', 'between:1,12'],
            'moratorio' => ['exclude_if:toggle,true', 'required', 'numeric'],
            'corriente' => ['exclude_if:toggle,true', 'required', 'numeric']
        ];
    }
}
