<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIgacRequest extends FormRequest
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
            'igac_r1' => ['required', 'file', 'mimes:txt'],
            'enable_r2' => ['required', 'boolean'],
            'igac_r2' => ['exclude_if:enable_r2,false', 'required', 'file', 'mimes:txt']
        ];
    }
}
