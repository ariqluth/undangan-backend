<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreKecamatanRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_kecamatan' => [
                'required',
                'regex:/^[a-zA-Z]+$/u',
                'min:3',
                'max:50',
                Rule::unique('kecamatan')
                    ->where('kabupaten_id', $this->kabupaten_id)
            ],
            'kabupaten_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_kecamatan.string' => 'Nama Kecamatan Wajib Diisi',
            'nama_kecamatan.required' => 'Nama Kecamatan Wajib Diisi',
            'nama_kecamatan.unique' => 'Nama Kecamatan Telah Ada',
            'nama_kecamatan.regex' => 'Nama Kabupaten Tidak Boleh Karakter',
            'nama_kecamatan.min' => 'Nama Kecamatan Kurang Dari Yang Ditentukan',
            'nama_kecamatan.max' => 'Nama Kecamatan Melebihi Dari Yang Ditentukan',
            'kabupaten_id.required' => 'Nama Kabupaten Wajib Diisi',
        ];
    }
}
