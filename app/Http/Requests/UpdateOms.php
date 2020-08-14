<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOms extends FormRequest
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
            'nomeOm' => 'required',
            'siglaOM' => 'required',
            'codom' => 'required',
            'codug' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nomeOm.required' => 'Campo obrigatório',
            'siglaOM.required' => 'Campo obrigatório',
            'codom.required' => 'Campo obrigatório',
            'codug.required' => 'Campo obrigatório',
                ];
    }
}
