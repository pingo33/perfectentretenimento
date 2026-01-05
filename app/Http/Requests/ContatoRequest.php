<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->isMethod('post')) {
            return [
                'nome'     => 'required|string|max:255',
                'email'    => 'required|email',
                'mensagem' => 'required|string|min:5',
            ];
        }

        return [];
    }
}
