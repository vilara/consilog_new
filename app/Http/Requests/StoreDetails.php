<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetails extends FormRequest
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
            'postograd_id' => 'required',
            'cpf' => 'required|unique:details|digits:11|numeric',
            'idt' => 'required|unique:details|numeric',
            'nome_guerra' => 'required',
            'om_id' => 'required',
            'sexo' => 'required',
            'sit' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'postograd_id.required' => 'Campo obrigatório!',
            'cpf.required' => 'Campo obrigatório!',
            'cpf.unique' => 'Este cpf já possui cadastro!',
            'cpf.digits' => 'o CPF precisa conter 11 dígitos',
            'cpf.numeric' => 'Apenas números',
            'idt.required' => 'Campo obrigatório!',
            'idt.numeric' => 'Apenas números',
            'idt.unique' => 'Esta idt já possui cadastro!',
            'nome_guerra.required' => 'Campo obrigatório!',
            'om_id.required' => 'Campo obrigatório!',
            'sexo.required' => 'Campo obrigatório!',
            'sit.required' => 'Campo obrigatório!',
                ];
    }
}
