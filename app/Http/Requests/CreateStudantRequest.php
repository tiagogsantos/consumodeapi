<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateStudantRequest extends FormRequest
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
            'name'       => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'profession' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation erros',
            'data'    => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'name.required'       => 'O campo nome é obrigatório',
            'last_name.required'  => 'O campo sobrenome é obrigatório',
            'email.required'      => 'O campo email é obrigatório',
            'profession.required' => 'O campo profissional é obrigatório',
        ];
    }
}
