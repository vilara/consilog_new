<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetails extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'postograd_id' => 'required',
            'cpf' => 'required|digits:11|numeric',
            'idt' => 'required|numeric',
            'nome_guerra' => 'required',
            'om_id' => 'required',
            'sexo' => 'required',
            'sit' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Campo obrigatório',
            'email.required' => 'Campo obrigatório',
            'postograd_id.required' => 'Campo obrigatório!',
            'cpf.required' => 'Campo obrigatório!',
            'cpf.digits' => 'o CPF precisa conter 11 dígitos',
            'cpf.numeric' => 'Apenas números',
            'idt.required' => 'Campo obrigatório!',
            'idt.numeric' => 'Apenas números',
            'nome_guerra.required' => 'Campo obrigatório!',
            'om_id.required' => 'Campo obrigatório!',
            'sexo.required' => 'Campo obrigatório!',
            'sit.required' => 'Campo obrigatório!',
                ];
    }
}
