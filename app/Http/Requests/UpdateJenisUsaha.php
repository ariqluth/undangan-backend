<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJenisUsaha extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_jenis_usaha' => 'required|string|regex:/^[a-zA-Z\s]+$/u|min:3|unique:jenis_usahas,nama_jenis_usaha,' . $this->jenis_usaha->id,
        ];
    }

    public function messages()
    {
        return [
            'nama_jenis_usaha.string' => 'Nama Jenis Usaha Wajib Diisi',
            'nama_jenis_usaha.required' => 'Nama Jenis Usaha Wajib Diisi',
            'nama_jenis_usaha.regex' => 'Nama Jenis Usaha Tidak Boleh Karakter',
            'nama_jenis_usaha.unique' => 'Nama Jenis Usaha Telah Ada',
            'nama_jenis_usaha.min' => 'Nama Jenis Usaha Kurang Dari Yang Ditentukan',
        ];
    }
}
