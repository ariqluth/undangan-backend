<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUraianJenisPerusahaanRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_uraian_jenis_perusahaan' =>
            'string|required|regex:/^[a-zA-Z\s]+$/u|unique:uraian_jenis_perusahaan|min:3'
        ];
    }

    public function messages()
    {
        return [
            'nama_uraian_jenis_perusahaan.string' => 'Nama Uraian Jenis Perusahaan Wajib Diisi',
            'nama_uraian_jenis_perusahaan.required' => 'Nama Uraian Jenis Perusahaan Wajib Diisi',
            'nama_uraian_jenis_perusahaan.unique' => 'Nama Uraian Jenis Perusahaan Telah Ada',
            'nama_uraian_jenis_perusahaan.regex' => 'Nama Uraian Jenis Perusahaan Tidak Boleh Angka',
            'nama_uraian_jenis_perusahaan.min' => 'Nama Uraian Jenis Perusahaan Kurang Dari Yang Ditentukan',
        ];
    }
}
