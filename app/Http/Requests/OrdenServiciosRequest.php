<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrdenServiciosRequest extends Request
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
        $rules = [
            'documento' => 'required|max:255|exists:pacientes,documento',
        ];

        foreach ($this->request->get('cups') as $key => $val) {
            $rules['cups.' . $key] = 'required';
        }
        foreach ($this->request->get('copago') as $key => $val) {
            $rules['copago.' . $key] = 'required|numeric|min:0';
        }
        foreach ($this->request->get('cantidad') as $key => $val) {
            $rules['cantidad.' . $key] = 'required|numeric|min:0';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = ['documento.exists' => 'El documento no se encuentra registrado en la base de datos.' ];
        foreach ($this->request->get('cups') as $key => $val) {
            $messages['cups.' . $key . '.required'] = 'El campo Cups es requerido en la fila ' . ($key + 1) . '.';
        }
        foreach ($this->request->get('copago') as $key => $val) {
            $messages['copago.' . $key . '.required'] = 'El campo copago es requerido en la fila ' . ($key + 1) . '.';
            $messages['copago.' . $key . '.numeric'] = 'El campo copago debe ser un número en la fila ' . ($key + 1) . '.';
            $messages['copago.' . $key . '.min.numeric'] = 'El campo copago debe ser mayor o igual a :min  en la fila ' . ($key + 1) . '.';
        }
        foreach ($this->request->get('cantidad') as $key => $val) {
            $messages['cantidad.' . $key . '.required'] = 'El campo cantidad es requerido en la fila ' . ($key + 1) . '.';
            $messages['cantidad.' . $key . '.numeric'] = 'El campo cantidad debe ser un número entero en la fila ' . ($key + 1) . '.';
            $messages['cantidad.' . $key . '.min.numeric'] = 'El campo cantidad debe ser mayor o igual a :min  en la fila ' . ($key + 1) . '.';
        }
        return $messages;
    }
}
