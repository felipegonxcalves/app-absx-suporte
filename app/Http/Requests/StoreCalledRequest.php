<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalledRequest extends FormRequest
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
            'assunto' => 'required',
            'descricao' => 'required',
            'dt_criacao_chamado' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'assunto.required' => 'O campo assunto é obrigatório.',
            'descricao.required' => 'O campo descrição é obrigatório.',
            'dt_criacao_chamado.required' => 'O campo data do chamado é obrigatório.',
            'status.required' => 'O campo status é obrigatório.',
        ];
    }
}
