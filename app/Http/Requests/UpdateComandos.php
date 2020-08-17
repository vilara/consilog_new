<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComandos extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomeCmdo' => 'required',
            'siglaCmdo' => 'required',
            'codomOm' => 'required',
            'codugOm' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nomeCmdo.required' => 'Campo obrigatório',
            'siglaCmdo.required' => 'Campo obrigatório',
            'codomOm.required' => 'Campo obrigatório',
            'codugOm.required' => 'Campo obrigatório',
                ];
    }
}
