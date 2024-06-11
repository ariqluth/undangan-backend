<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKabupatenRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'nama_kabupaten' => [
                'string',
                'required',
                'regex:/^[a-zA-Z]+$/',
                'min:3',
                'max:50',
                Rule::unique('kabupaten', 'nama_kabupaten')->ignore($this->kabupaten->id),

            ],
        ];
    }

    public function messages()
    {
        return [
            'nama_kabupaten.string' => 'Nama Kabupaten Wajib Diisi',
            'nama_kabupaten.required' => 'Nama Kabupaten Wajib Diisi',
            'nama_kabupaten.regex' => 'Nama Kabupaten Tidak Boleh Karakter',
            'nama_kabupaten.min' => 'Nama Kabupaten Kurang Dari Yang Ditentukan',
            'nama_kabupaten.max' => 'Nama Kabupaten Melebihi Dari Yang Ditentukan',
            'nama_kabupaten.unique' => 'Nama Kabupaten Telah Ada',
        ];
    }
}
