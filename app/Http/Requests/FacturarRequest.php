<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FacturarRequest extends Request
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
}
