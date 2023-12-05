<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePredioRequest extends FormRequest
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
            'cedulacatastral' => ['required', 'string'],
            'ord' => ['required', 'string'],
            'tot' => ['required', 'string'],
            'e' => ['nullable', 'string'],
            'd' => ['nullable', 'string'],
            'documento' => ['nullable', 'string'],
            'nombrepropietario' => ['required', 'string'],
            'direccion' => ['required', 'string'],
            'ha' => ['nullable', 'string'],
            'met2' => ['nullable', 'string'],
            'areacon' => ['required', 'string'],
            'avaluo' => ['required', 'decimal'],
            'vigencia' => ['required', 'string'],
            'estado' => ['required', 'string'],
            'tipopredio' => ['required', 'string'],
            'clasifica' => ['nullable', 'string'],
            'estratos' => ['nullable', 'string']
        ];
    }
}
