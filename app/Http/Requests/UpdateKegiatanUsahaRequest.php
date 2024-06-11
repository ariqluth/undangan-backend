<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKegiatanUsahaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_kegiatan_usaha' =>
            'string|required|regex:/^[a-zA-Z\s]+$/u|min:3|unique:kegiatan_usahas,nama_kegiatan_usaha,' . $this->kegiatan_usaha->id
        ];
    }

    public function messages()
    {
        return [
            'nama_kegiatan_usaha.string' => 'Nama Kegiatan Usaha Wajib Diisi',
            'nama_kegiatan_usaha.required' => 'Nama Kegiatan Usaha Wajib Diisi',
            'nama_kegiatan_usaha.unique' => 'Nama Kegiatan Usaha Telah Ada',
            'nama_kegiatan_usaha.regex' => 'Nama Kegiatan Usaha Tidak Boleh Angka',
            'nama_kegiatan_usaha.min' => 'Nama Kegiatan Usaha Kurang Dari Yang Ditentukan',
        ];
    }
}
