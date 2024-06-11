<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJenisLegalitas extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'nama_jenis_legalitas' => 'required|string|min:3',
        ];
    }
    public function messages()
    {
        return [
            'nama_jenis_legalitas.string' => 'Nama Jenis Lagalitas Wajib Diisi',
            'nama_jenis_legalitas.required' => 'Nama Jenis Legalitas Wajib Diisi',
            'nama_jenis_legalitas.min' => 'Nama Jenis Legalitas Kurang Dari Yang Ditentukan',

        ];
    }
}
