<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInteresRequest extends FormRequest
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
            'vigencia' => ['required', 'date_format:Y', 'after:1970', 'before:today'],
            'mes' => ['required', 'integer', 'between:1,12'],
            'moratorio' => ['required', 'numeric'],
            'corriente' => ['required', 'numeric'],
        ];
    }
}
