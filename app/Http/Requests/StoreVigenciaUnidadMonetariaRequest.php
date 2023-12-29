<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVigenciaUnidadMonetariaRequest extends FormRequest
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
            'unidad_monetaria_id' => ['required', 'integer'],
            'valor' => ['required', 'numeric']
        ];
    }
}
