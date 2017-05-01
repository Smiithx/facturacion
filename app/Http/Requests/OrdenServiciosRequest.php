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
            'nombre' => 'required|max:255',
            'documento' => 'required|max:255',
            'aseguradora_id' => 'required',
            'contrato' => 'required|max:255',
        ];

        foreach ($this->request->get('cups') as $key => $val) {
            $rules['cups.' . $key] = 'required';
        }
        foreach ($this->request->get('copago') as $key => $val) {
            $rules['copago.' . $key] = 'required|numeric|min:0';
        }
        foreach ($this->request->get('valor_unitario') as $key => $val) {
            $rules['valor_unitario.' . $key] = 'required|numeric|min:0';
        }
        foreach ($this->request->get('valor_total') as $key => $val) {
            $rules['valor_total.' . $key] = 'required|numeric|min:0';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        foreach ($this->request->get('cups') as $key => $val) {
            $messages['cups.' . $key . '.required'] = 'El campo "Cups" es requerido en la fila ' . $key + 1 . '.';
        }
        foreach ($this->request->get('copago') as $key => $val) {
            $messages['copago.' . $key . '.required'] = 'El campo "copago" es requerido en la fila ' . $key + 1 . '.';
            $messages['copago.' . $key . '.numeric'] = 'El campo "copago" debe ser un número en la fila ' . $key + 1 . '.';
            $messages['copago.' . $key . '.min.numeric'] = 'El campo copago debe ser mayor o igual a :min  en la fila ' . $key + 1 . '.';
        }
        foreach ($this->request->get('valor_unitario') as $key => $val) {
            $messages['valor_unitario.' . $key . '.required'] = 'El campo "valor unitario" es requerido en la fila ' . $key + 1 . '.';
            $messages['valor_unitario.' . $key . '.numeric'] = 'El campo "valor unitario" debe ser un número en la fila ' . $key + 1 . '.';
            $messages['valor_unitario.' . $key . '.min.numeric'] = 'El campo valor unitario debe ser mayor o igual a :min  en la fila ' . $key + 1 . '.';
        }
        foreach ($this->request->get('valor_total') as $key => $val) {
            $rules['valor_total.' . $key] = 'required|numeric|min:0';
            $messages['valor_total.' . $key . '.required'] = 'El campo "valor total" es requerido en la fila ' . $key + 1 . '.';
            $messages['valor_total.' . $key . '.numeric'] = 'El campo "valor total" debe ser un número en la fila ' . $key + 1 . '.';
            $messages['valor_total.' . $key . '.min.numeric'] = 'El campo valor total debe ser mayor o igual a :min  en la fila ' . $key + 1 . '.';
        }

        return $messages;
    }
}
