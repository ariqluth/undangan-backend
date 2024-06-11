<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateKelurahanRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'kabupaten_id' => 'required|string',
            'kecamatan_id' => 'required|string',
            'nama_kelurahan' => [
                'required',
                'regex:/^[a-zA-Z]+$/u',
                'min:3',
                'max:50',
                Rule::unique('kelurahan')
                    ->where('kecamatan_id', $this->kecamatan_id)
                    ->ignore($this->kelurahan->id),
            ],
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'kabupaten_id.required' => 'Nama Kabupaten Wajib Diisi',
            'kecamatan_id.required' => 'Nama Kecamatan Wajib Diisi',
            'nama_kelurahan.string' => 'Nama Kelurahan Wajib Diisi',
            'nama_kelurahan.required' => 'Nama Kelurahan Wajib Diisi',
            'nama_kelurahan.unique' => 'Nama Kelurahan Telah Ada',
            'nama_kelurahan.regex' => 'Nama Kelurahan Tidak Boleh Karakter',
            'nama_kelurahan.min' => 'Nama Kelurahan Kurang Dari Yang Ditentukan',
            'nama_kelurahan.max' => 'Nama Kelurahan Melebihi Dari Yang Ditentukan',
            'kecamatan_id.string' => 'Nama Kecamatan Wajib Diisi',
            'kecamatan_id.required' => 'Nama Kecamatan Wajib Diisi',
            'kabupaten_id.string' => 'Nama Kabupaten Wajib Diisi',
            'kabupaten_id.required' => 'Nama Kabupaten Wajib Diisi',
            'status.required' => 'Status Wajib Diisi',
        ];
    }
}
