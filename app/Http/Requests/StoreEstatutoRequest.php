<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstatutoRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:255'],
            'vigencia_desde' => ['required', 'date_format:Y'],
            'vigencia_hasta' => ['required', 'date_format:Y'],
            'norma_predial' => ['required', 'boolean'],
            'bomberil' => ['required', 'boolean'],
            'bomberil_predial' => ['required_if:bomberil,true', 'boolean'],
            'bomberil_tarifa' => ['required_if:bomberil,true', 'boolean'],
            'bomberil_tasa' => ['required_if:bomberil,true', 'integer'],
            'ambiental' => ['required', 'boolean'],
            'ambiental_predial' => ['required_if:ambiental,true', 'boolean'],
            'ambiental_tarifa' => ['required_if:ambiental,true', 'boolean'],
            'ambiental_tasa' => ['required_if:ambiental,true', 'integer'],
            'alumbrado' => ['required', 'boolean'],
            'alumbrado_urbano' => ['exclude_if:alumbrado,false', 'required', 'boolean', 'accepted_if:alumbrado_rural,false'],
            'alumbrado_rural' => ['exclude_if:alumbrado,false', 'required', 'boolean', 'accepted_if:alumbrado_urbano,false'],
            'alumbrado_tarifa' => ['required_if:alumbrado,true', 'boolean'],
            'alumbrado_tasa' => ['required_if:alumbrado,true', 'integer'],
            'recibo_caja' => ['required', 'integer']
        ];
    }
}
