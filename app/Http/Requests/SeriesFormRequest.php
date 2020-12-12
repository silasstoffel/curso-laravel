<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => ':attribute é obrigatório',
            //'nome.required' => 'o campo nome é obrigatório',
            'nome.min'      => 'o campo nome precisa ter pelo menos dois caracteres',
        ];
    }
}
