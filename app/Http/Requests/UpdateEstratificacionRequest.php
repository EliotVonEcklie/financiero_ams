<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstratificacionRequest extends FormRequest
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
            'predio_tipo_id' => ['exclude_if:toggle,true', 'required', 'exists:predio_tipos,id'],
            'destino_economico_id' => ['exclude_if:toggle,true', 'required', 'exists:destino_economicos,id'],
            'tarifa' => ['exclude_if:toggle,true', 'required'],
            'tasa' => ['exclude_if:toggle,true', 'required', 'numeric']
        ];
    }
}
