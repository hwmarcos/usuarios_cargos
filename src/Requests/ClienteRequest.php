<?php

namespace Helderwmarcos\Interbits\Requests;

use App\Http\Requests\Request;

class ClienteRequest extends Request
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
            'nome' => 'required|max:100',
            'email' => "required|email|max:100|unique:interbits_usuarios,email,{$this->id}",
            'cargo_id' => 'required',
            'ddd' => 'required|integer',
            'celular' => 'required|integer'
        ];
    }
}
