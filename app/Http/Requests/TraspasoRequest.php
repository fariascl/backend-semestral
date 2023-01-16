<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;


class TraspasoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "tras_cd_origen" => 'required|numeric|exists:centro_distribucion,id|different:tras_cd_destino',
            "tras_cd_destino" => 'required|numeric|exists:centro_distribucion,id|different:tras_cd_origen',
            "tras_estado" => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido',
            'numeric' => 'El campo :attribute debe ser de tipo number',
            'exists' => 'El código de :attribute no existe',
            'string' => 'el campo :attribute tiene que ser un string',
            'different' => 'El CD origen debe ser diferente a el CD destino'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors()->all(), Response::HTTP_BAD_REQUEST)
        );
    }

}
