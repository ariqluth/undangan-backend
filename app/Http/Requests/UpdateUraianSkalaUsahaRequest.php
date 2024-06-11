<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUraianSkalaUsahaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_uraian_skala_usaha' =>
            'string|required|regex:/^[a-zA-Z\s]+$/u|min:3|unique:uraian_skala_usaha,nama_uraian_skala_usaha,' . $this->uraian_skala_usaha->id
        ];
    }

    public function messages()
    {
        return [
            'nama_uraian_skala_usaha.string' => 'Nama Uraian Resiko Proyek Wajib Diisi',
            'nama_uraian_skala_usaha.required' => 'Nama Uraian Resiko Proyek Wajib Diisi',
            'nama_uraian_skala_usaha.unique' => 'Nama Uraian Resiko Proyek Telah Ada',
            'nama_uraian_skala_usaha.regex' => 'Nama Uraian Resiko Proyek Tidak Boleh Angka',
            'nama_uraian_skala_usaha.min' => 'Nama Uraian Resiko Proyek Kurang Dari Yang Ditentukan',
        ];
    }
}
